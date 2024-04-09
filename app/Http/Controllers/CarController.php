<?php

namespace App\Http\Controllers;

use App\Services\car\ICarService;
use App\Services\car_photo\ICarPhotoService;
use Illuminate\Support\Facades\Validator;

class CarController extends ControllerBase
{
    function __construct(ICarService $service, protected ICarPhotoService $carPhotoService) {
        parent::__construct($service);
    }

    function getCarsByUserSubscription($userSubscriptionId) {
        return $this->ok($this->service->getCarsByUserSubscriptionId($userSubscriptionId));
    }

    function createCar() {
        $validator = Validator::make(request()->all(), $this->createRules());

        if ($validator->fails()) {
            return $this->badRequest([ 'validation' => $validator->errors() ]);
        }

        $keys = array_keys($this->createRules());

        $data = [];
        foreach ($keys as $key) {
            $data[$key] = request()->input($key);
        }

        $result = $this->service->create($data);

        if ($result) {
            // Insert images
            $images = [];

            $index = 0;
            while (request()->hasFile('image-'.$index)) {
                $image = request()->file('image-'.$index);
                $uploadResult = $this->carPhotoService->uploadImage($result->id, $image);
                $index++;

                if ($uploadResult) {
                    array_push($images, $uploadResult);
                }
            }

            $result['car_photos'] = $images;
        }

        return ($result)
        ? $this->created($result)
        : $this->badRequest([ 'message' => 'Fialed to create item!' ]);
    }

    function updateCar($id) {
        $validator = Validator::make(request()->all(), $this->updateRules());

        if ($validator->fails()) {
            return $this->badRequest([ 'validation' => $validator->errors() ]);
        }

        $old = $this->service->get($id);

        if (!$old) {
            return $this->notFound([ 'message' => 'Item not found!' ]);
        }

        $updated = (object) array_merge((array) $old, request()->all());
        $uresult = $this->service->update($updated);

        if ($uresult) {
            // Newly Inserted images
            $images = [];

            $upload_keys = array_keys(request()->all());
            $upload_keys = array_filter($upload_keys, function($key) {
                return str_starts_with($key, 'upload-image-');
            });
            while (count($upload_keys) > 0) {
                $top = array_pop($upload_keys);
                /*****************************/
                $file = request()->file($top);
                $uploadResult = $this->carPhotoService->uploadImage($updated->id, $file);
            }

            $delete_keys = array_keys(request()->all());
            $delete_keys = array_filter($delete_keys, function($key) {
                return str_starts_with($key, 'delete-image-');
            });
            while (count($delete_keys) > 0) {
                $top = array_pop($delete_keys);
                $delete_id = request()->input($top);
                $this->carPhotoService->deleteById($delete_id);
            }
        }

        return ($uresult)
        ? $this->ok($this->service->get($id))
        : $this->badRequest([ 'message' => 'Failed to update item!' ]);
    }

    function createRules()
    {
        return [
            'user_subscription_id' => 'required|exists:user_subscription,id',
            'car_brand' => 'required|string|max:50',
            'car_model' => 'required|string|max:30',
            'car_year' => 'required|numeric',
            'car_plate' => 'required|string',
            'car_description' => 'required|string|max:255',
            'car_features' => 'required|string', // array|jsonlike
            'units_available' => 'required|numeric',
            'units_left' => 'required|numeric',
        ];
    }

    function updateRules()
    {
        return $this->createRules();
    }
}
