<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        // Paginate: 5 users per page
        $data['users'] = $userModel->paginate(6);

        // Pass pager to the view
        $data['pager'] = $userModel->pager;

        // return the view with users
        return view('users', $data);
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->find($id);

        if (!$data['user']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("User with ID $id not found");
        }

        return view('users/edit', $data);
    }

    public function update($id)
    {
        $userModel = new UserModel();

        $data = [
            'first_name'   => $this->request->getPost('first_name'),
            'last_name'    => $this->request->getPost('last_name'),
            'email'        => $this->request->getPost('email'),
            'user_type_id' => $this->request->getPost('user_type_id'),
            'contact_number' => $this->request->getPost('contact_number'),
        ];

        $userModel->update($id, $data);

        return redirect()->to('/users')->with('success', 'User updated successfully.');
    }
}
