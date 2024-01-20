<?php
namespace App\Services\user;

use App\Models\User;
use App\Services\GenericService;

class UserService extends GenericService implements IUserService {
    function __construct() {
        parent::__construct(User::class);
    }

    function getPendingUsers() {
        return $this->model::with('user_access')->where('verified_by_admin', false)->where('is_rejected', false)->get();
    }
}


