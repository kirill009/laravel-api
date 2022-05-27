<?php

namespace App\Http\Controllers\Api;

use App\Models\Guide;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GuideController extends BaseController
{
    private $fileStorageJson = 'db.json';
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->input('storage') && $request->input('storage') === "json") {
            if (Storage::disk('local')->exists($this->fileStorageJson)) {
                $contents = Storage::get($this->fileStorageJson);
                return $this->sendResponse($contents, 'All guide.');
            } else {
                return $this->sendError('Json file not exist');
            }
        } else {
            $elementsGiude = Guide::all();
            return $this->sendResponse($elementsGiude->toArray(), 'All guide.');
        }
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

        if ($request->input('storage') && $request->input('storage') === "json") {
            if (Storage::disk('local')->exists($this->fileStorageJson)) {
                Storage::append($this->fileStorageJson, json_encode($input));
            } else {
                Storage::put($this->fileStorageJson, json_encode($input), 'private');
            }
            return $this->sendResponse($input, 'Guide element in json file created successfully.');
        } else {
            $elementGiude = Guide::create($input);
            return $this->sendResponse($elementGiude->toArray(), 'Guide element created successfully.');
        }
    }
}
