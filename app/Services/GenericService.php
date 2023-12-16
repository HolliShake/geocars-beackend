<?php
namespace App\Services;


class GenericService implements IGenericService {

    protected $model;

    function __construct($model) {
        $this->model = $model;
    }

    function get($id) {
        return $this->model::find($id);
    }

    function all() {
        return $this->model::get();
    }

    function create($data) {
        return $this->model::create($data);
    }

    function createAll($dataArray) {
        return $this->model::insert($dataArray);
    }

    function update($data) {
        return $this->model::where('id', $data->id)->update($data);
    }

    function delete($data) {
        return $this->model::where('id', $data->id)->delete();
    }

}
