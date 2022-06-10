<?php
namespace App\Contracts;

use Illuminate\Http\Request;

Interface IActionsData {

    public function set(array $request);

    public function get();
}
