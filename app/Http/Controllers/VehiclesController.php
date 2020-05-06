<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\Fileupload;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\FileUploadController;


class VehiclesController extends Controller {

    public function __construct() {
        $this->middleware('jwt-auth');
    }

    public function index() {
        $data['status'] = true;
        $data['vehicle'] = Vehicle::all();
        return response()->json(compact( 'data'));
    }

    public function store(Request $request)
    {
        // $t = validator([
        //     'reg_no' => 'required',
        //     'vehicle_type' => 'required',
        //     'model' => 'required',
        //     'brand' => 'required',
        //     'fuel_type' => 'required',
        //     'rent_price' => 'required|numeric',
        //     'mfd' => 'required | string',
        //     'booking_status' => 'required|string',
        //     'description' => 'required | string',
        //     'img_link' => 'required | string',
        //     'owner_id' => 'required | numeric'
        // ]);
        try {
            $validator = Validator::make($request->all(), [
                'reg_no' => 'required',
                'vehicle_type' => 'required',
                'model' => 'required',
                'brand' => 'required',
                'fuel_type' => 'required',
                'rent_price' => 'required|numeric',
                'mfd' => 'required | string',
                'booking_status' => 'required|string',
                'description' => 'required | string',
                'img_link' => 'required | string',
                'owner_id' => 'required | numeric'
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'fail', 'message' => $validator->errors()->all()]);
            } else {
                $data = $request->All();
                Vehicle::create([
                    'reg_no' => $data['reg_no'],
                    'vehicle_type' => $data['vehicle_type'],
                    'model' => $data['model'],
                    'brand' => $data['brand'],
                    'fuel_type' => $data['fuel_type'],
                    'rent_price' => $data['rent_price'],
                    'mfd' => $data['mfd'],
                    'booking_status' => $data['booking_status'],
                    'description' => $data['description'],
                    'img_link' => $data['img_link'],
                    'owner_id' => $data['owner_id']
                   
                ]);
                return response()->json(array('status' => true, 'msg' => 'Successfully Created'), 200);
            }
        } catch (\Exception $e) {
            return response()->json(array('message' => 'could_not_create_employee'), 500);
        }
    }

    public function show($id)
    {
        try {
            $vehicle = Vehicle::where('id', $id)->first();
            if ($vehicle != null) {
                return response()->json(array('status' => true, 'employee' => $vehicle), 200);
            } else {
                return response()->json(array('message' => 'vehicle_not_found'), 200);
            }
        } catch (\Exception $e) {
            return response()->json(array('message' => 'could_not_add_new_vehicle_details'), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $vehicle = Vehicle::where('id', $id)->first();
            $data = $request->All();
            if ($vehicle != null) {
                Vehicle::where('id', $id)->update([
                    'reg_no' => $data['reg_no'],
                    'vehicle_type' => $data['vehicle_type'],
                    'model' => $data['model'],
                    'brand' => $data['brand'],
                    'fuel_type' => $data['fuel_type'],
                    'rent_price' => $data['rent_price'],
                    'mfd' => $data['mfd'],
                    'booking_status' => $data['booking_status'],
                    'description' => $data['description'],
                    'img_link' => $data['img_link'],
                    'owner_id' => $data['owner_id']
                ]);
            } else {
                return response()->json(array('message' => 'vehicle_not_found'), 200);
            }
            return response()->json(array('status' => true, 'message' => 'updated_vehicle_details'), 200);
        } catch (\Exception $e) {
            return response()->json(array('message' => 'could_not_update_vehicle'), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $employee = Vehicle::where('id', $id)->first();
            if ($employee != null) {
                Vehicle::where('id', $id)->delete();
            } else {
                return response()->json(array('message' => 'vehicle_not_found'), 200);
            }
            return response()->json(array('status' => true, 'message' => 'vehicle_deleted'), 200);
        } catch (\Exception $e) {
            return response()->json(array('message' => 'could_not_update_vehicle'), 500);
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
