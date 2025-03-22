<?php

namespace App\Services;

use App\Repositories\ChronicDegenerativeDiseaseRepository;

class ChronicDegenerativeDiseaseService
{
    protected $chronicDegenerativeDiseaseRepository;

    public function __construct(ChronicDegenerativeDiseaseRepository $repository) {
        $this->chronicDegenerativeDiseaseRepository = $repository;
    }

    public function createDegenerativeDiseaseRecord(int $pathologicalHistoryId) {
        $data = [
            [
                'disease' => 'Obesidad',
                'applies' => false,
                'observations' => null,
                'pathological_history_id' => $pathologicalHistoryId
            ],
            [
                'disease' => 'Diabetes Mellitus',
                'applies' => false,
                'observations' => null,
                'pathological_history_id' => $pathologicalHistoryId
            ],
            [
                'disease' => 'Hipertensión Arterial',
                'applies' => false,
                'observations' => null,
                'pathological_history_id' => $pathologicalHistoryId
            ],
            [
                'disease' => 'Dislipidemia',
                'applies' => false,
                'observations' => null,
                'pathological_history_id' => $pathologicalHistoryId
            ],
            [
                'disease' => 'Neoplasias',
                'applies' => false,
                'observations' => null,
                'pathological_history_id' => $pathologicalHistoryId
            ],
            [
                'disease' => 'Neurológicas',
                'applies' => false,
                'observations' => null,
                'pathological_history_id' => $pathologicalHistoryId
            ],
        ];

        $this->chronicDegenerativeDiseaseRepository->create($data);
    }
}
