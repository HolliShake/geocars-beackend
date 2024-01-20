<?php

namespace App\Services\user;

use App\Services\IGenericService;

interface IUserService extends IGenericService {
    function getPendingUsers();
}


