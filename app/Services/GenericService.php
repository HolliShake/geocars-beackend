<?php
namespace App\Services;


class GenericService implements IGenericService {

    protected $model;

    function __construct($model) {
        $this->model = $model;
    }

    function get($id) {
        return (object) ($this->model::find($id)->toArray());
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
        return $this->model::find($data->id)->update((array) $data);
    }

    function delete($data) {
        return $this->model::where('id', $data->id)->delete();
    }

    function deleteById($id) {
        return $this->model::where('id', $id)->delete();
    }

}
