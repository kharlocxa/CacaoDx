<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

class User extends BaseController
{
    use ResponseTrait;

    private $key = "cacaodx1234567890";

    // ✅ GET /api/user/profile
    public function profile()
    {
        $authHeader = $this->request->getHeaderLine('Authorization');
        if (!$authHeader) {
            return $this->failUnauthorized('Missing Authorization header');
        }

        $token = str_replace('Bearer ', '', $authHeader);

        try {
            $decoded = JWT::decode($token, new Key($this->key, 'HS256'));
        } catch (\Exception $e) {
            return $this->failUnauthorized('Invalid or expired token');
        }

        $userModel = new UserModel();
        $user = $userModel->find($decoded->uid);

        if (!$user) {
            return $this->failNotFound('User not found');
        }

        // Return all fields separately for React Native
        return $this->respond([
            'id'             => $user['id'],
            'first_name'     => $user['first_name'],
            'last_name'      => $user['last_name'],
            'email'          => $user['email'],
            'contact_number' => $user['contact_number'] ?? ''
        ]);
    }

    // POST /api/user/update
    public function updateProfile()
    {
        $authHeader = $this->request->getHeaderLine('Authorization');
        if (!$authHeader) {
            return $this->failUnauthorized('Missing Authorization header');
        }

        $token = str_replace('Bearer ', '', $authHeader);

        try {
            $decoded = JWT::decode($token, new Key($this->key, 'HS256'));
        } catch (\Exception $e) {
            return $this->failUnauthorized('Invalid or expired token');
        }

        $data = json_decode($this->request->getBody(), true);
        $userModel = new UserModel();
        $updateData = [];

        if (isset($data['first_name'])) $updateData['first_name'] = $data['first_name'];
        if (isset($data['last_name']))  $updateData['last_name'] = $data['last_name'];
        if (isset($data['contact_number'])) $updateData['contact_number'] = $data['contact_number'];

        if (!empty($data['email'])) {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                return $this->fail('Invalid email format', 400);
            }

            $existing = $userModel->where('email', $data['email'])
                                  ->where('id !=', $decoded->uid)
                                  ->first();
            if ($existing) {
                return $this->fail('Email is already in use', 400);
            }

            $updateData['email'] = $data['email'];
        }

        if (!empty($data['password'])) {
            $updateData['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        if (empty($updateData)) {
            return $this->fail('No fields to update', 400);
        }

        $userModel->update($decoded->uid, $updateData);

        $user = $userModel->find($decoded->uid);

        return $this->respond([
            'message' => 'Profile updated successfully',
            'user' => [
                'id'             => $user['id'],
                'first_name'     => $user['first_name'],
                'last_name'      => $user['last_name'],
                'email'          => $user['email'],
                'contact_number' => $user['contact_number'] ?? '',
            ]
        ]);
    }
}