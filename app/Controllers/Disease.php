<?php

namespace App\Controllers;

use App\Models\DiseaseModel;
use CodeIgniter\Controller;

class Disease extends Controller
{
    public function index()
    {
        $model = new DiseaseModel();

        // Use paginate instead of findAll
        $data['diseases'] = $model->paginate(10); // 10 per page
        $data['pager']    = $model->pager;        // CI4 pager object
        $data['content']  = 'diseases';           // tells your main index what section to render

        // Load view
        return view('disease', $data);
    }
}
