<?php
namespace App\Services\user_access;

use App\Services\IGenericService;

interface IUserAccessService extends IGenericService {
   function getAccessListByUserId($user_id);
}
