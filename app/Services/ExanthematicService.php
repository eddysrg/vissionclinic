<?php

namespace App\Services;

use App\Repositories\ExanthematicRepository;

class ExanthematicService
{

    protected $exanthematicRepository;

    public function __construct(ExanthematicRepository $repository) {
        $this->exanthematicRepository = $repository;
    }

    public function createExanthematic(int $pathologicalHistoryId) {
        $data = [
            [
                'disease' => 'Varicela',
                'applies' => false,
                'observations' => null,
                'pathological_history_id' => $pathologicalHistoryId
            ],
            [
                'disease' => 'Rubeola',
                'applies' => false,
                'observations' => null,
                'pathological_history_id' => $pathologicalHistoryId
            ],
            [
                'disease' => 'Sarampión',
                'applies' => false,
                'observations' => null,
                'pathological_history_id' => $pathologicalHistoryId
            ],
            [
                'disease' => 'Escarlatina',
                'applies' => false,
                'observations' => null,
                'pathological_history_id' => $pathologicalHistoryId
            ],
            [
                'disease' => 'Exantema Súbito',
                'applies' => false,
                'observations' => null,
                'pathological_history_id' => $pathologicalHistoryId
            ],
        ];

        $this->exanthematicRepository->create($data);
    }
}
