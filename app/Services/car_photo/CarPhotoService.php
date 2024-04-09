<?php

namespace App\Services\car_photo;

use App\Models\CarPhoto;
use App\Services\GenericService;

class CarPhotoService extends GenericService implements ICarPhotoService {
    function __construct() {
        parent::__construct(CarPhoto::class);
    }

    function uploadImage($car_id, $file_from_request) {
        $file = $file_from_request;
        $fileName = time().'-'.$file->getClientOriginalName().'.'.$file->getClientOriginalExtension();
        $path = public_path('storage/images/cars');
        $file->move($path, $fileName);
        return $this->create([
            'path' => $path,
            'file' => $fileName,
            'extension' => $file->getClientOriginalExtension(),
            'car_id' => $car_id
        ]);
    }
}
