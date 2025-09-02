<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Images extends BaseController
{
    public function index()
    {
        // Show upload form
        return view('images'); // <-- use images.php instead of index.php
    }

    public function upload()
    {
        $imageFile = $this->request->getFile('image');

        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            // Generate a random name for security
            $newName = $imageFile->getRandomName();

            // Move file to /public/upload
            $imageFile->move(FCPATH . 'upload', $newName);

            return redirect()->to('/images/list')->with('success', 'Image uploaded successfully!');
        }

        return redirect()->back()->with('error', 'Failed to upload image.');
    }

    public function list()
    {
        $files = [];

        // Check if upload folder exists
        $path = FCPATH . 'upload';
        if (is_dir($path)) {
            $files = array_diff(scandir($path), ['.', '..']);
        }

        return view('images_list', ['files' => $files]); 
        // ✅ create a view file "Views/images_list.php"
    }
}
