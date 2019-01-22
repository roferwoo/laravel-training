<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Transformers\PermissionTransformer;

class PermissionsController extends ApiController
{
    public function index()
    {
        $permissions = $this->user()->getAllPermissions();

        return $this->response->collection($permissions, new PermissionTransformer());
    }
}
