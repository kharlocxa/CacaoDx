<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('login'); // shows login form
    }

    public function authenticate()
    {
        $userModel = new UserModel();

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        // if ($user && password_verify($password, $user['password'])) {
        if ($user && $password === $user['password']) {
            session()->set([
                'user_id'    => $user['id'],
                'user_type'  => $user['user_type_id'],
                'first_name' => $user['first_name'],
                'last_name'  => $user['last_name'],
                'email'      => $user['email'],
                'isLoggedIn' => true
            ]);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    }

    public function registration()
    {
        return view('register'); // shows register form
    }

    public function create()
    {
        $userModel = new \App\Models\UserModel();

        $data = [
            'first_name'     => $this->request->getPost('first_name'),
            'last_name'      => $this->request->getPost('last_name'),
            'email'          => $this->request->getPost('email'),
            'password'       => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'contact_number' => $this->request->getPost('contact_number'),

            // 👇 Force new users to Admin
            'user_type_id'   => 1,  
            'registered_at'  => date('Y-m-d H:i:s'),
        ];

        $userModel->save($data);

        return redirect()->to('/login')->with('success', 'Registration successful! Please log in.');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }
}
