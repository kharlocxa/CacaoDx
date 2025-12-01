<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'rating', 'comments', 'created_at'];
    protected $useTimestamps = false;
    protected $returnType = 'array';

    protected $validationRules = [
        'user_id' => 'required|integer',
        'rating' => 'required|integer|greater_than[0]|less_than[6]',
        'comments' => 'required|min_length[3]'
    ];

    protected $validationMessages = [
        'rating' => [
            'greater_than' => 'Rating must be at least 1',
            'less_than' => 'Rating must be at most 5'
        ],
        'comments' => [
            'min_length' => 'Comments must be at least 3 characters long'
        ]
    ];
}