<?php

namespace App\Http\Controllers;

use App\House;
use App\Fileupload;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\FileUploadController;


class HousesController extends Controller {

    public function __construct() {
        $this->middleware('jwt-auth');
    }

    public function index() {
        $data['status'] = true;
        $data['house'] = House::all();
        return response()->json(compact( 'data'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [

                'house_no' => 'required',
                'house_type' => 'required',
                'house_location' => 'required|string|min:2',
                'description' => 'required|string',
                'img_link' => 'required | string',
                'owner_id' => 'required | numeric',

            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'fail', 'message' => $validator->errors()->all()]);
            } else {
                $data = $request->All();
                House::create([
                    'house_no' => $data['house_no'],
                    'house_type' => $data['house_type'],
                    'house_location' => $data['house_location'],
                    'description' => $data['description'],
                    'img_link' => $data['img_link'],
                    'owner_id' => $data['owner_id'],
                ]);
                return response()->json(array('status' => true, 'msg' => 'Successfully Created'), 200);
            }
        } catch (\Exception $e) {
            return response()->json(array('message' => 'could_not_add_house_details'), 500);
        }
    }

    public function show($id)
    {
        try {
            $house = House::where('id', $id)->first();
            if ($house != null) {
                return response()->json(array('status' => true, 'house' => $house), 200);
            } else {
                return response()->json(array('message' => 'house_not_found'), 200);
            }
        } catch (\Exception $e) {
            return response()->json(array('message' => 'could_not_add_new_house'), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $house = House::where('id', $id)->first();
            $data = $request->All();
            if ($house != null) {
                House::where('id', $id)->update([
                    'house_no' => $data['house_no'],
                    'house_type' => $data['house_type'],
                    'house_location' => $data['house_location'],
                    'description' => $data['description'],
                    'img_link' => $data['img_link'],
                    'owner_id' => $data['owner_id'],
                ]);
            } else {
                return response()->json(array('message' => 'house_not_found'), 200);
            }
            return response()->json(array('status' => true, 'message' => 'updated_house_detail'), 200);
        } catch (\Exception $e) {
            return response()->json(array('message' => 'could_not_update_house_details'), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $house = House::where('id', $id)->first();
            if ($house != null) {
                House::where('id', $id)->delete();
            } else {
                return response()->json(array('message' => 'house_not_found'), 200);
            }
            return response()->json(array('status' => true, 'message' => 'house_deleted'), 200);
        } catch (\Exception $e) {
            return response()->json(array('message' => 'could_not_update_house_details'), 500);
        }
    }

    public function fileupload(Request $request){
        $validator = Validator::make($request->all(), [
            'file' => 'required'
        ]);
        $data = $request->all();
        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'message' => $validator->errors()->all()]);
        } else {
            if (isset($data['file'])) {
                $file = $data['file'];
                unset($data['file']);
                $data['name'] = FileUploadController::fileUpload($file, 'uploads/students');
            }
            Fileupload::create($data);
            return response()->json(array('status' => true, 'msg' => 'Successfully created'), 200);
        }
    }

    public function filelist(){
        $data['files'] = Fileupload::all();
        return response()->json(compact( 'data'));
    }

    public function filedelete($id)
    {
        try {
            $employee = Fileupload::where('id', $id)->first();
            if ($employee != null) {
                Fileupload::where('id', $id)->delete();
            } else {
                return response()->json(array('message' => 'file_not_found'), 200);
            }
            return response()->json(array('status' => true, 'message' => 'file_deleted'), 200);
        } catch (\Exception $e) {
            return response()->json(array('message' => 'could_not_file'), 500);
        }
    }
}
