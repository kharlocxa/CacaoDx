<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'activity', 'created_at'];

    public function getLogsWithUsersPaginated($perPage = 7)
    {
        return $this->select('logs.*, users.first_name, users.last_name')
                    ->join('users', 'users.id = logs.user_id')
                    ->orderBy('logs.created_at', 'DESC')
                    ->paginate($perPage);
    }
}
