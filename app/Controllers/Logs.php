<?php

namespace App\Controllers;

use App\Models\LogModel;

class Logs extends BaseController
{
    public function index()
    {
        $logModel = new LogModel();
        $data['logs'] = $logModel->getLogsWithUsersPaginated(6);
        $data['pager'] = $logModel->pager;
        
        return view('activity_log', $data);
    }
}
