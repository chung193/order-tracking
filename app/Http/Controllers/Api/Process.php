<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as Controller;
use Illuminate\Http\Request;
use App\Imports\FileImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\ShipmentResource;
use App\Models\Shipment as Model;

class Process extends Controller
{
    public function data($id = null)
    {
        $data = $id ? Model::with('orders.merchandise')->where('id', $id)->get() : Model::with('orders.merchandise')->get();
        return $this->sendResponse(ShipmentResource::collection($data), 'Data retrieved successfully.');
    }
    public function loadToDb($filename)
    {
        Excel::import(new FileImport, $filename);
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        if ($request->hasFile('file')) {
            $fileName = $file->getClientOriginalName();

            $arr = explode(".", $fileName);

            if (file_exists(storage_path() . '/app/files/' . $arr[0] . '.' . $arr[1])) {
                $i = 1;
                $temp = $arr[0] . '-' . $i;
                while (file_exists(storage_path() . '/app/files/' . $arr[0] . '-' . $i . '.' . $arr[1])) {
                    $i++;
                }
                $arr[0] =  $arr[0] . '-' . $i;
            }

            $is_upload_success = $file->storeAs('files/', $arr[0] . '.' . $arr[1]);
            $input =  [
                'filename' => $arr[0] . '.' . $arr[1],
            ];
            $this->loadToDb(storage_path() . '/app/files/' . $arr[0] . '.' . $arr[1]);
            return $is_upload_success;
        } else {
            return response()->json(['upload_file_not_found'], 400);
        }
    }
}
