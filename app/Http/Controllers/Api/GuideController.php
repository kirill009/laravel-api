<?php

namespace App\Http\Controllers\Api;

use App\Models\Guide;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Contracts\ContractIActionsData\StorageFactory;

class GuideController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $objectStorage = StorageFactory::make($request->input('storage'));
        $data = $objectStorage->get();
        if ($data) {
            return $this->sendResponse($data, 'All data guide.');
        }
        return $this->sendError('Data not exist');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->except('storage');
        $validator = Validator::make($input, [
            'full_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $objectStorage = StorageFactory::make($request->input('storage'));
        $datum = $objectStorage->set($input);
        if ($datum) {
            return $this->sendResponse($datum, 'Guide element created successfully.');
        }
        return $this->sendError('Guide element not created.');
    }
}
