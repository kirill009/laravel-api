<?php

namespace App\Contracts\ContractIActionsData;

use App\Contracts\IActionsData;
use Illuminate\Http\Request;
use App\Models\Guide;

class StorageDB implements IActionsData
{
    public function set(array $input)
    {
        $elementGiude = Guide::create($input);
        if ($elementGiude) {
            return $elementGiude->toArray();
        }
        return false;//$this->sendResponse($elementGiude->toArray(), 'Guide element created successfully.');
    }

    public function get()
    {
        $elementsGiude = Guide::all();
        if ($elementsGiude) {
            return $elementsGiude->toArray();
        }
        return false;
    }
}
