<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';   // name of your DB table
    protected $primaryKey = 'id'; // primary key column

    protected $allowedFields = [
        'first_name',
        'last_name',
        'email',
        'password', 
        'contact_number',
        'password'
    ];

    // Optional: auto timestamps if you have created_at / updated_at fields
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
