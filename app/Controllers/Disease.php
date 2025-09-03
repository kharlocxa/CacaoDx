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

        return view('disease', $data);
    }

    // ✅ Store new disease
    public function store()
    {
        $model = new DiseaseModel();

        // Validate inputs
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'        => 'required|min_length[3]',
            'type'        => 'required',
            'cause'       => 'required',
            'plant_part'  => 'required',
        ]);

        if (! $validation->withRequest($this->request)->run()) {
            return redirect()->back()->with('error', $validation->listErrors());
        }

        // Save into DB
        $model->save([
            'name'       => $this->request->getPost('name'),
            'type'       => $this->request->getPost('type'),
            'cause'      => $this->request->getPost('cause'),
            'plant_part' => $this->request->getPost('plant_part'),
        ]);

        return redirect()->to('/disease')->with('success', 'Disease added successfully.');
    }
}
