<?php

return [
    App\Providers\AppServiceProvider::class,
    Laravel\Sanctum\SanctumServiceProvider::class,
    'Toastr' => 'Yoeunes\Toastr\Facades\ToastrFacade',
    'Yoeunes\Toastr\ToastrServiceProvider',
    Intervention\Image\ImageServiceProvider::class,

];
