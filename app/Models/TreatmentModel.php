<?php

namespace App\Models;

use CodeIgniter\Model;

class TreatmentModel extends Model
{
    protected $table = 'treatments';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'disease_id',
        'diagnosis_id',
        'plant_part_id',
        'description',
        'treatment',
        'prevention',
        'recommended_action'
    ];
    
    /**
     * Get treatment by disease ID
     */
    public function getByDiseaseId($diseaseId)
    {
        return $this->where('disease_id', $diseaseId)->first();
    }
    
    /**
     * Get treatment with disease details
     */
    public function getTreatmentWithDisease($diseaseId)
    {
        return $this->select('
                treatments.*,
                diseases.name as disease_name,
                diseases.type as disease_type
            ')
            ->join('diseases', 'diseases.id = treatments.disease_id')
            ->where('treatments.disease_id', $diseaseId)
            ->first();
    }
}