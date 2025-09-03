<?php

namespace App\Models;

use CodeIgniter\Model;

class DiagnosisModel extends Model
{
    protected $table      = 'diagnosis';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 
        'plant_part_id', 
        'disease_id', 
        'image_path',
        'confidence',
        'notes', 
        'diagnosis_date'
    ];

    // Custom query with joins
        public function getDiagnosisWithDetails($perPage = 6)
    {
        return $this->select('
                diagnosis.id,
                CONCAT(users.first_name, " ", users.last_name) as user_name,
                diseases.name as disease_name,
                treatments.name as treatment,        -- ✅ add treatment
                plant_part.part as plant_part,
                diagnosis.image_path,
                diagnosis.confidence,
                diagnosis.notes,
                diagnosis.diagnosis_date
            ')
            ->join('users', 'users.id = diagnosis.user_id')
            ->join('diseases', 'diseases.id = diagnosis.disease_id')
            ->join('treatments', 'treatments.id = diagnosis.treatment_id')  // ✅ join treatments
            ->join('plant_part', 'plant_part.id = diagnosis.plant_part_id')
            ->paginate($perPage);
    }
}