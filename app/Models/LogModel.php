<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'activity_log';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'activity', 'log_date'];

    public function getLogsWithUsersPaginated($perPage = 7)
    {
        return $this->select('activity_log.*, users.first_name, users.last_name')
                    ->join('users', 'users.id = activity_log.user_id', 'left')
                    ->orderBy('activity_log.log_date', 'DESC')
                    ->paginate($perPage);
    }
}

