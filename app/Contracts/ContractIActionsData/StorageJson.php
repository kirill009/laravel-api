<?php

namespace App\Contracts\ContractIActionsData;

use App\Contracts\IActionsData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageJson implements IActionsData
{
    protected $fileStorageJson = 'db.json';
    protected $typeStorageJson = 'local';

    public function set(array $input)
    {
        $contents = Storage::get($this->fileStorageJson);
        if ($contents) {
            $contents = json_decode($contents, true);
            $contents[] = $input;
        } else {
            $contents = [];
            $contents[] = $input;
        }
        
        if (Storage::put($this->fileStorageJson, json_encode($contents), 'private')) {
            return $input;
        }
        return false;
    }

    public function get()
    {
        if (Storage::disk($this->typeStorageJson)->exists($this->fileStorageJson)) {
            $contents = Storage::get($this->fileStorageJson);
            return json_decode($contents, true);
        }
        return false;
    }
}
