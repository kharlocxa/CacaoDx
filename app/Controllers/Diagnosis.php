<?php

namespace App\Controllers;

use App\Models\DiagnosisModel;
use CodeIgniter\Controller;

class Diagnosis extends Controller
{
    public function index()
    {
        $model = new DiagnosisModel();

        // Get joined data with pagination
        $data['diagnosis'] = $model->getDiagnosisWithDetails(10);
        $data['pager']     = $model->pager;

        return view('diagnosis', $data);
    }
}
