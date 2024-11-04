<?php

namespace Domain\Facades\ImageFacade;

use Domain\Services\ImageService\ImageService;
use Illuminate\Support\Facades\Facade;

class ImageFacade extends Facade {

    public function getFacadeAccessor(){
        return ImageService::class;
        
    }
}