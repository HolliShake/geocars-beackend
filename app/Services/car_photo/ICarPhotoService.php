<?php
namespace App\Services\car_photo;

use App\Services\IGenericService;

interface ICarPhotoService extends IGenericService {
    function uploadImage($car_id, $file_from_request);
}
