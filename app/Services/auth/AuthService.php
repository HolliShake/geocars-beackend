<?php
namespace App\Services\auth;

use App\Models\User;
use App\Services\GenericService;

class AuthService extends GenericService implements IAuthService {

    public function __construct()
    {
        parent::__construct(User::class);
    }

    function getByEmail($email) {
        return $this->model::with('user_access')->where('email', $email)->first();
    }

}


