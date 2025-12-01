<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function profile()
    {
        $userId = session()->get('user_id'); // or from JWT/token

        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if ($user) {
            return $this->response->setJSON([
                'id'    => $user['id'],
                'name'  => $user['name'],
                'email' => $user['email'],
            ]);
        }

        return $this->response->setJSON(['error' => 'User not found'], 404);
    }
}
