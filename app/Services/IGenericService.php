<?php
namespace App\Services;

interface IGenericService {
    function get($id);
    function all();
    function create($data);
    function createAll($dataArray);
    function update($data);
    function delete($data);
}
