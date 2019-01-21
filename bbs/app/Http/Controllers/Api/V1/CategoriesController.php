<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use App\Transformers\CategoryTransformer;

class CategoriesController extends ApiController
{
    public function index()
    {
        return $this->response->collection(Category::all(), new CategoryTransformer());
    }
}
