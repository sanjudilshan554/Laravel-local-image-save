<?php

namespace App\Http\Controllers\ImageSaveController;

use App\Http\Controllers\Controller;
use Domain\Facades\ImageFacade\ImageFacade;
use Illuminate\Http\Request;

class ImageServiceController extends Controller
{
    public function store(Request $request){
        return $request;
        return ImageFacade::store($request->all());
    }
}
