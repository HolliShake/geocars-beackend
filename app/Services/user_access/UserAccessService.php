<?php
namespace App\Services\user_access;

use App\Models\UserAccess;
use App\Services\GenericService;

class UserAccessService extends GenericService implements IUserAccessService {


    public function __construct()
    {
        parent::__construct(UserAccess::class);
    }

    function getAccessListByUserId($user_id) {
        return $this->model::where('user_id', $user_id)->get();
    }

}
