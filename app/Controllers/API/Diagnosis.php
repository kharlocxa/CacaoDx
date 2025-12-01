<?php

namespace App\Controllers\Api;

use App\Models\DiagnosisModel;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Diagnosis extends ResourceController
{
    protected $modelName = 'App\Models\DiagnosisModel';
    protected $format    = 'json';
    private $key = 'cacaodx1234567890';

    public function history()
    {
        try {
            $authHeader = $this->request->getHeaderLine('Authorization');
            if (!$authHeader) {
                return $this->failUnauthorized('Missing token');
            }

            $token = str_replace('Bearer ', '', $authHeader);
            
            try {
                $decoded = JWT::decode($token, new Key($this->key, 'HS256'));
            } catch (\Exception $e) {
                log_message('error', 'JWT Decode Error: ' . $e->getMessage());
                return $this->failUnauthorized('Invalid token: ' . $e->getMessage());
            }

            // Check if uid exists
            if (!isset($decoded->uid)) {
                log_message('error', 'No uid in token. Token contents: ' . json_encode($decoded));
                return $this->fail('User ID not found in token', 400);
            }

            $userId = $decoded->uid;
            log_message('info', 'Fetching history for user ID: ' . $userId);
            
            $db = \Config\Database::connect();

            $query = $db->table('diagnosis')
                ->select('
                    diagnosis.id,
                    diagnosis.image_path,
                    diagnosis.confidence,
                    diagnosis.diagnosis_date,
                    diagnosis.notes,
                    diseases.name AS disease_name,
                    plant_part.part AS plant_part_name
                ')
                ->join('diseases', 'diseases.id = diagnosis.disease_id', 'left')
                ->join('plant_part', 'plant_part.id = diagnosis.plant_part_id', 'left')
                ->where('diagnosis.user_id', $userId)
                ->orderBy('diagnosis.diagnosis_date', 'DESC')
                ->get()
                ->getResultArray();

            log_message('info', 'Found ' . count($query) . ' diagnosis records');
            
            return $this->respond([
                'status' => 'success',
                'data' => $query,
                'count' => count($query)
            ]);

        } catch (\Exception $e) {
            log_message('error', 'History Error: ' . $e->getMessage());
            return $this->fail('Server error: ' . $e->getMessage(), 500);
        }
    }
}