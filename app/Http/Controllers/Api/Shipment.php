<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as Controller;
use Illuminate\Http\Request;
use App\Models\Shipment as Model;
use App\Http\Resources\ShipmentResource;

class Shipment extends Controller
{
    //
    public function index()
    {
        $data = Model::all();
        return $this->sendResponse(ShipmentResource::collection($data), 'Data retrieved successfully.');
    }

    public function search($key = null)
    {
        $data = $key ? Model::where('car_code', 'like', '%' . $key . '%')->get() : Model::all();
        return $this->sendResponse(ShipmentResource::collection($data), 'Data retrieved successfully.');
    }
}
