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

class Auth extends BaseController
{
    use ResponseTrait;

    private $key = "cacaodx1234567890"; // change this!

    public function register()
    {
        $data = json_decode($this->request->getBody(), true);
        
        // Validate required fields
        if (empty($data['first_name']) || empty($data['last_name']) || empty($data['email']) || 
            empty($data['password']) || empty($data['contact_number']) || empty($data['user_type_id'])) {
            return $this->fail('All fields are required', 400);
        }
        
        $userModel = new UserModel();

        if ($userModel->where('email', $data['email'])->first()) {
            return $this->fail('Email already registered', 400);
        }

        $insertData = [
            'first_name'     => $data['first_name'],
            'last_name'      => $data['last_name'],
            'email'          => $data['email'],
            'password'       => $data['password'], // NOT HASHED - FOR TESTING ONLY
            // 'password'       => password_hash($data['password'], PASSWORD_DEFAULT), // Use this in production!
            'contact_number' => $data['contact_number'],
            'user_type_id'   => $data['user_type_id']
        ];

        // Add farm_location only if it exists and is not null
        if (!empty($data['farm_location'])) {
            $insertData['farm_location'] = $data['farm_location'];
        }

        try {
            $result = $userModel->insert($insertData);
            
            if ($result === false) {
                $errors = $userModel->errors();
                log_message('error', 'Insert failed: ' . json_encode($errors));
                return $this->fail('Registration failed: ' . json_encode($errors), 500);
            }
            
            return $this->respondCreated(['message' => 'Account created successfully']);
        } catch (\Exception $e) {
            log_message('error', 'Registration exception: ' . $e->getMessage());
            return $this->fail('Registration failed: ' . $e->getMessage(), 500);
        }
    }

    public function login()
    {
        $data = json_decode($this->request->getBody(), true);
        $userModel = new UserModel();
        $user = $userModel->where('email', $data['email'])->first();

        // Testing with plain text password comparison
        if (!$user || $data['password'] !== $user['password']) {
            return $this->failUnauthorized('Invalid credentials');
        }

        // Generate JWT with long expiration (30 days)
        $issuedAt   = time();
        $expiration = $issuedAt + (30 * 24 * 60 * 60); // 30 days
        $payload = [
            'iat'   => $issuedAt,
            'exp'   => $expiration,
            'uid'   => $user['id'],
            'email' => $user['email']
        ];

        $token = JWT::encode($payload, $this->key, 'HS256');

        return $this->respond([
            'message' => 'Login successful',
            'token'   => $token,
            'user'    => [
                'id'    => $user['id'],
                'email' => $user['email'],
                'name'  => $user['first_name'] . ' ' . $user['last_name']
            ]
        ]);
    }

    public function logout()
    {
        return $this->respond([
            'message' => 'Logged out successfully'
        ]);
    }
}