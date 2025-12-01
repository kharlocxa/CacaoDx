<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\FeedbackModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

class Feedback extends BaseController
{
    use ResponseTrait;

    private $key = "cacaodx1234567890"; // Same key as Auth controller

    private function validateToken()
    {
        $header = $this->request->getHeaderLine('Authorization');
        
        if (empty($header)) {
            return null;
        }

        // Remove 'Bearer ' prefix
        $token = str_replace('Bearer ', '', $header);

        try {
            $decoded = JWT::decode($token, new Key($this->key, 'HS256'));
            return $decoded;
        } catch (\Exception $e) {
            log_message('error', 'Token validation failed: ' . $e->getMessage());
            return null;
        }
    }

    public function create()
    {
        // Validate token
        $decoded = $this->validateToken();
        
        if (!$decoded) {
            return $this->failUnauthorized('Invalid or expired token');
        }

        $user_id = $decoded->uid;

        // Get input data
        $data = json_decode($this->request->getBody(), true);

        // Validate input
        if (empty($data['rating']) || $data['rating'] < 1 || $data['rating'] > 5) {
            return $this->fail('Rating must be between 1 and 5', 400);
        }

        if (empty($data['comments']) || trim($data['comments']) === '') {
            return $this->fail('Comments are required', 400);
        }

        // Prepare data for insertion
        $feedbackData = [
            'user_id' => $user_id,
            'rating' => $data['rating'],
            'comments' => trim($data['comments']),
            'created_at' => date('Y-m-d H:i:s')
        ];

        try {
            $feedbackModel = new FeedbackModel();
            $feedback_id = $feedbackModel->insert($feedbackData);

            if ($feedback_id === false) {
                $errors = $feedbackModel->errors();
                log_message('error', 'Feedback insert failed: ' . json_encode($errors));
                return $this->fail('Failed to submit feedback: ' . json_encode($errors), 500);
            }

            return $this->respondCreated([
                'message' => 'Feedback submitted successfully',
                'data' => [
                    'id' => $feedback_id,
                    'user_id' => $user_id,
                    'rating' => $data['rating'],
                    'comments' => trim($data['comments'])
                ]
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Feedback submission exception: ' . $e->getMessage());
            return $this->fail('Failed to submit feedback: ' . $e->getMessage(), 500);
        }
    }

    public function index()
    {
        // Validate token
        $decoded = $this->validateToken();
        
        if (!$decoded) {
            return $this->failUnauthorized('Invalid or expired token');
        }

        $user_id = $decoded->uid;

        try {
            $feedbackModel = new FeedbackModel();
            $feedbacks = $feedbackModel->where('user_id', $user_id)
                                       ->orderBy('created_at', 'DESC')
                                       ->findAll();

            return $this->respond([
                'message' => 'Feedback retrieved successfully',
                'data' => $feedbacks
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Feedback retrieval exception: ' . $e->getMessage());
            return $this->fail('Failed to retrieve feedback: ' . $e->getMessage(), 500);
        }
    }
}