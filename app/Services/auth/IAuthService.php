<?php
namespace App\Services\auth;

use App\Services\IGenericService;

interface IAuthService extends IGenericService {
   function getByEmail($email);
}
