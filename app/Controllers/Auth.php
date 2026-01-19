<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('login');
    }

    public function authenticate()
    {
        //VALIDATE INPUT
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email'    => 'required|valid_email|max_length[255]',
            'password' => 'required|min_length[8]|max_length[255]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid input. Please check your email and password.');
        }

        // GET SANITIZED INPUT
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // USE PARAMETERIZED QUERY (CodeIgniter handles this)
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        // USE PASSWORD HASHING (NOT plain text comparison!)
        if ($user && password_verify($password, $user['password'])) {
            
            // REGENERATE SESSION ID (prevent session fixation)
            session()->regenerate();
            
            // SET SESSION DATA
            session()->set([
                'user_id'    => $user['id'],
                'user_type'  => $user['user_type_id'],
                'first_name' => $user['first_name'],
                'last_name'  => $user['last_name'],
                'email'      => $user['email'],
                'isLoggedIn' => true
            ]);

            // LOG THE LOGIN (optional but recommended)
            $this->logActivity($user['id'], 'User logged in');

            return redirect()->to('/dashboard');
        } else {
            // GENERIC ERROR MESSAGE (don't reveal if email exists)
            return redirect()->back()
                ->with('error', 'Invalid credentials.');
        }
    }

    public function logout()
    {
        // Log before destroying session
        $userId = session()->get('user_id');
        if ($userId) {
            $this->logActivity($userId, 'User logged out');
        }

        // DESTROY SESSION COMPLETELY
        session()->destroy();
        
        return redirect()->to('/login')
            ->with('success', 'You have been logged out.');
    }

    // Log user activities
    private function logActivity($userId, $activity)
    {
        $logModel = new \App\Models\LogModel();
        $logModel->insert([
            'user_id'  => $userId,
            'activity' => $activity,
            'log_date' => date('Y-m-d H:i:s')
        ]);
    }
}