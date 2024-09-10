<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order as Model;

class Order extends Controller
{
    //
    public function index()
    {
        $data = Model::all();
        return $this->sendResponse(OrderResource::collection($data), 'Data retrieved successfully.');
    }
    public function search($key = null)
    {
        $data = $key ? Model::where('address', 'like', '%' . $key . '%')->get() : Model::all();
        return $this->sendResponse(OrderResource::collection($data), 'Data retrieved successfully.');
    }
}
