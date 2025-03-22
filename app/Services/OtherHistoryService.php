<?php

namespace App\Services;

use App\Repositories\OtherHistoryRepository;

class OtherHistoryService
{
    protected $otherHistoryRepository;

    public function __construct(OtherHistoryRepository $otherHistoryRepository) {
        $this->otherHistoryRepository = $otherHistoryRepository;
    }

    public function createOtherHistoriesRecords(int $pathologicalHistoryId) {
        $data = [
            [
                'type_of_history' => 'Parasitarias',
                'date' => null,
                'type_of_examination' => null,
                'observations' => null,
                'pathological_history_id' => $pathologicalHistoryId
            ],
            [
                'type_of_history' => 'Traumáticos',
                'date' => null,
                'type_of_examination' => null,
                'observations' => null,
                'pathological_history_id' => $pathologicalHistoryId
            ],
            [
                'type_of_history' => 'Fracturas',
                'date' => null,
                'type_of_examination' => null,
                'observations' => null,
                'pathological_history_id' => $pathologicalHistoryId
            ],
            [
                'type_of_history' => 'Alérgicos',
                'date' => null,
                'type_of_examination' => null,
                'observations' => null,
                'pathological_history_id' => $pathologicalHistoryId
            ],
            [
                'type_of_history' => 'Quirúrgicos',
                'date' => null,
                'type_of_examination' => null,
                'observations' => null,
                'pathological_history_id' => $pathologicalHistoryId
            ],
            [
                'type_of_history' => 'Hospitalizaciones previas',
                'date' => null,
                'type_of_examination' => null,
                'observations' => null,
                'pathological_history_id' => $pathologicalHistoryId
            ],
            [
                'type_of_history' => 'Transfusionales',
                'date' => null,
                'type_of_examination' => null,
                'observations' => null,
                'pathological_history_id' => $pathologicalHistoryId
            ],
        ];

        $this->otherHistoryRepository->create($data);
    }
}
