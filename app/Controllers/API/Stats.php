<?php

namespace App\Controllers\Api;
use App\Models\UserModel;
use App\Models\DiagnosisModel;
use App\Models\DiseaseModel;
use CodeIgniter\RESTful\ResourceController;

class Stats extends ResourceController
{
    public function index()
    {
        $userModel = new UserModel();
        $diagnosisModel = new DiagnosisModel();
        $diseaseModel = new DiseaseModel();

        $data = [
            'total_users'     => $userModel->countAll(),
            'total_diagnoses' => $diagnosisModel->countAll(),
            'total_diseases'  => $diseaseModel->countAll(),
        ];

        return $this->respond($data);
    }
}