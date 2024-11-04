<?php

namespace App\Http\Controllers\ImageSaveController;

use App\Http\Controllers\Controller;
use domain\Facades\ImageFacade\ImageFacade;
use Illuminate\Http\Request;

class ImageServiceController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            return ImageFacade::store($request->file('image'));
        } else {
            return 1;
        }
    }

    public function all()
    {
        return ImageFacade::all();
    }
}
