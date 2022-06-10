<?php

namespace App\Contracts\ContractIActionsData;

use App\Contracts\IActionsData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageJson implements IActionsData
{
    private $fileStorageJson = 'db.json';

    public function set(array $input)
    {
        if (Storage::disk('local')->exists($this->fileStorageJson)) {
            return Storage::append($this->fileStorageJson, json_encode($input));
        } else {
            return Storage::put($this->fileStorageJson, json_encode($input), 'private');
        }
        return false;
    }

    public function get()
    {
        if (Storage::disk('local')->exists($this->fileStorageJson)) {
            return Storage::get($this->fileStorageJson);
        }
        return false;
    }
}
