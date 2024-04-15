<?php

namespace App\Http\Controllers;

use App\Services\auth\IAuthService;
use App\Services\user_access\IUserAccessService;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends ControllerBase {

    function __construct(IAuthService $service, protected readonly IUserAccessService $userAccessService) {
        parent::__construct($service);
    }

    function refresh() {
        $user = request()->user();
        $user = $this->service->getByEmail($user->email);

        $scope = [];

        foreach ($user->user_access as $access) {
            array_push($scope, $access->role . "-can-" . $access->action);
        }

        $user->access_token = ($user->createToken('Geocars', $scope))->accessToken;

        return $this->ok($user);
    }

    function loginAttempt() {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->badRequest([ 'validation' => $validator->errors() ]);
        }

        $user = $this->service->getByEmail(request()->input('email'));

        if (!$user) {
            return $this->unAuthorize([ 'message' => 'Invalid credentials' ]);
        }

        if (!$user->verified_by_admin) {
            return $this->unAuthorize([ 'message' => 'Account is not yet verified by admin' ]);
        }

        if (!Hash::check(request()->input('password'), $user->password)) {
            return $this->unAuthorize([ 'message' => 'Invalid credentials' ]);
        }

        $scope = [];

        foreach ($user->user_access as $access) {
            array_push($scope, $access->role . "-can-" . $access->action);
        }

        $user->access_token = ($user->createToken('Geocars', $scope))->accessToken;

       return $this->ok($user);
    }

    function registerUser() {
        $validator = Validator::make(request()->all(), $this->createRules());

        if ($validator->fails()) {
            return $this->badRequest([ 'validation' => $validator->errors() ]);
        }

        $newuser = [
            ...request()->all(),
            'password' => Hash::make(request()->input('password')),
            'verified_by_admin' => strcmp(request()->input('role'), 'Renter') === 0,
        ];
        $newuser = $this->service->create($newuser);

        if (!$newuser) {
            return $this->badRequest([ 'message' => 'Failed to create user!' ]);
        }

        $user_access = $this->userAccessService->createAll($this->getAccess($newuser['role'], $newuser));

        if (!$user_access) {
            $newuser->delete();
        }

        $newuser->user_access = $this->userAccessService->getAccessListByUserId($newuser->id);

        return ($newuser && $user_access)
            ? $this->created($newuser)
            : $this->badRequest([ 'message' => 'Failed to create user!' ]);
    }

    function generateAdmin($secret_key) {
        if (strcmp(env('APP_SECRETKEY'), $secret_key) !== 0) {
            return $this->unAuthorize([ 'message' => 'Invalid secret key' ]);
        }

        $user = $this->service->create([
            'email' => 'philippandrew.redondo@ustp.edu.ph',
            'password' => Hash::make('@dmingeocarsdev'),
            'first_name' => 'Philipp Andrew',
            'last_name' => 'Redondo',
            'middle_name' => 'Roa',
            'gender' => 'Male',
            'country' => 'Philippines',
            'address' => 'Igpit Youngsville, Opol, Misamis Oriental',
            'mobile_number' => '0945',
            'role' => 'Admin',
            'verified_by_admin' => true,
            'is_rejected' => false
        ]);

        if (!$user) {
            return $this->badRequest([ 'message' => 'Failed to create admin!' ]);
        }

        $user_access = $this->userAccessService->createAll([
            [
                'user_id' => $user->id,
                'role' => 'admin',
                'action' => 'read',
                'created_at' => Date::now(),
                'updated_at' => null
            ],
            [
                'user_id' => $user->id,
                'role' => 'admin',
                'action' => 'create',
                'created_at' => Date::now(),
                'updated_at' => null
            ],
            [
                'user_id' => $user->id,
                'role' => 'admin',
                'action' => 'update',
                'created_at' => Date::now(),
                'updated_at' => null
            ],
            [
                'user_id' => $user->id,
                'role' => 'admin',
                'action' => 'delete',
                'created_at' => Date::now(),
                'updated_at' => null
            ]
        ]);

        if (!$user_access) {
            $user->delete();
        }

        $user->user_access = $this->userAccessService->getAccessListByUserId($user->id);

        return ($user && $user_access)
            ? $this->created($user)
            : $this->badRequest([ 'message' => 'Failed to create admin!' ]);
    }


    function getAccess($role, $user) {
        if (strcmp($role, 'Lender') === 0) {
            return [
                [
                    'user_id' => $user->id,
                    'role' => 'lender',
                    'action' => 'read',
                    'created_at' => Date::now(),
                    'updated_at' => null
                ],
                [
                    'user_id' => $user->id,
                    'role' => 'lender',
                    'action' => 'create',
                    'created_at' => Date::now(),
                    'updated_at' => null
                ],
                [
                    'user_id' => $user->id,
                    'role' => 'lender',
                    'action' => 'update',
                    'created_at' => Date::now(),
                    'updated_at' => null
                ],
                [
                    'user_id' => $user->id,
                    'role' => 'lender',
                    'action' => 'delete',
                    'created_at' => Date::now(),
                    'updated_at' => null
                ]
            ];
        }
        else if (strcmp($role, 'Renter') === 0) {
            return [
                [
                    'user_id' => $user->id,
                    'role' => 'renter',
                    'action' => 'read',
                    'created_at' => Date::now(),
                    'updated_at' => null
                ],
                [
                    'user_id' => $user->id,
                    'role' => 'renter',
                    'action' => 'create',
                    'created_at' => Date::now(),
                    'updated_at' => null
                ],
                [
                    'user_id' => $user->id,
                    'role' => 'renter',
                    'action' => 'update',
                    'created_at' => Date::now(),
                    'updated_at' => null
                ],
                [
                    'user_id' => $user->id,
                    'role' => 'renter',
                    'action' => 'delete',
                    'created_at' => Date::now(),
                    'updated_at' => null
                ]
            ];
        }
        else {
            return [];
        }
    }

    function createRules() {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'middle_name' => 'required|string|max:50',
            'birthday' => 'required|date',
            'country' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'mobile_number' => 'required|numeric',
            'role' => 'required|string|max:50',
        ];
    }
}
