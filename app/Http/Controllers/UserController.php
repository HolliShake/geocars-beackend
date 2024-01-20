<?php
namespace App\Http\Controllers;

use App\Services\user\IUserService;
use Illuminate\Support\Facades\Validator;

class UserController extends ControllerBase {

    function __construct(IUserService $service) {
        parent::__construct($service);
    }

    function getPendingUsers() {
        return $this->service->getPendingUsers();
    }

    function getAllUsers() {
        return $this->service->all();
    }

    function approveUser($user_id) {
        $user = $this->service->get($user_id);

        if (!$user) {
            return $this->notFound(null);
        }

        $updated = (object) array_merge((array) $user, [ 'verified_by_admin' => true, 'is_rejected' => false ]);
        $uresult = $this->service->update($updated);

        return ($uresult)
            ? $this->ok($updated)
            : $this->badRequest([ 'message' => 'approve unsuccessful!' ]);
    }

    function rejectUser($user_id) {
        $user = $this->service->get($user_id);

        if (!$user) {
            return $this->notFound(null);
        }

        $updated = (object) array_merge((array) $user, [ 'verified_by_admin' => true, 'is_rejected' => true ]);
        $uresult = $this->service->update($updated);

        return ($uresult)
            ? $this->ok($updated)
            : $this->badRequest([ 'message' => 'approve unsuccessful!' ]);
    }

}
