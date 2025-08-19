<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function registration()
    {
        // Load the registration view
        return view('registration');
    }

    public function login()
    {
        // Load the login view
        return view('login');
    }

    public function create()
    {
        $model = new UserModel();

        // Validate and create user
        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'contact_number' => $this->request->getPost('contact_number'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        if ($model->insert($data)) {
            return redirect()->to('/login')->with('success', 'Registration successful. Please log in.');
        } else {
            return redirect()->back()->with('errors', $model->errors());
        }
    }

    public function authenticate()
    {
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Set user session
            session()->set('loggedIn', true);
            session()->set('userId', $user['id']);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }
}