<?php
namespace App\Contracts\ContractIActionsData;

use App\Contracts\ContractIActionsData\StorageJson;
use App\Contracts\ContractIActionsData\StorageDB;

class StorageFactory
{
    public function make(string $typeStorage)
    {
        switch ($typeStorage) {
            case "json":
                return new StorageJson();
            case "db":
                return new StorageDB();
            default:
                return false;
        }
    }
}
