<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as Controller;
use Illuminate\Http\Request;
use App\Models\Merchandise as Model;
use App\Http\Resources\MerchandiseResource;

use Validator;

class Merchandise extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Model::all();
        return $this->sendResponse(MerchandiseResource::collection($data), 'Data retrieved successfully.');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $data = Model::create($input);
        return $this->sendResponse(new MerchandiseResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Model::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new MerchandiseResource($data), 'Data retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update($request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $data = new Model();
        $data->name = $input['name'];
        $data->save();

        return $this->sendResponse(new MerchandiseResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Model::find($id);
        $data->delete();
        return $this->sendResponse([], 'Data deleted successfully.');
    }
}
