<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Transformers\LinkTransformer;

class LinksController extends ApiController
{
    public function index(Link $link)
    {
        $links = $link->getAllCached();

        return $this->response->collection($links, new LinkTransformer());
    }
}
