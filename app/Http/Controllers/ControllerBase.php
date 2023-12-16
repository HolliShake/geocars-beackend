<?php

namespace App\Http\Controllers;

use App\Services\IGenericService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ControllerBase extends Controller {

    public $service;

    function __construct($service) {
        $this->service = $service;
    }

    function ok($data) {
        return response()->json($data, 200);
    }

    function created($data) {
        return response()->json($data, 201);
    }

    function noContent() {
        return response('', 204);
    }

    function badRequest($data) {
        return response()->json($data, 400);
    }

    function unAuthorize($data) {
        return response()->json($data, 403);
    }

    function notFound($data) {
        return response()->json($data, 404);
    }

    function statusCode($data='', $code=200) {
        return response()->json($data, $code);
    }
    //

    function genericCreate() {
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

        return ($result)
        ? $this->created($result)
        : $this->badRequest([ 'message' => 'Fialed to create item!' ]);
    }

    function genericUpdate($id) {
        $validator = Validator::make(request()->all(), $this->updateRulesRules());

        if ($validator->fails()) {
            return $this->badRequest([ 'validation' => $validator->errors() ]);
        }

        $old = $this->service->get($id);

        if (!$old) {
            return $this->notFound([ 'message' => 'Item not found!' ]);
        }

        $updated = (object) array_merge((array) $old, request()->all());
        $uresult = $this->service->update($updated);

        return ($uresult)
        ? $this->ok($updated)
        : $this->badRequest([ 'message' => 'Fialed to update item!' ]);
    }

    function genericDelete($id) {
        $old = $this->service->get($id);

        if (!$old) {
            return $this->notFound([ 'message' => 'Item not found!' ]);
        }

        $uresult = $this->service->delete($old);

        return ($uresult)
        ? $this->noContent()
        : $this->badRequest([ 'message' => 'Fialed to delete item!' ]);
    }

    function createRules() {
        return [];
    }

    function updateRules() {
        return $this->createRules();
    }

}
