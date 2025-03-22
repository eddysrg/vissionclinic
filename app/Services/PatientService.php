<?php
namespace App\Services;

use App\Repositories\MedicalRecordRepository;
use App\Repositories\PathologicalHistoryRepository;
use App\Repositories\PatientRepository;
use App\Repositories\RecordRepository;
use Illuminate\Support\Facades\DB;

class PatientService
{
    protected $patientRepository;
    protected $recordRepository;
    protected $medicalRecordRepository;
    protected $pathologicalHistoryRepository;
    protected $exanthematicService;
    protected $chronicDegenerativeDiseaseService;
    protected $otherHistoryService;


    public function __construct(
        PatientRepository $patientRepository,
        RecordRepository $recordRepository,
        MedicalRecordRepository $medicalRecordRepository,
        PathologicalHistoryRepository $pathologicalHistoryRepository,
        ExanthematicService $exanthematicService,
        ChronicDegenerativeDiseaseService $chronicDegenerativeDiseaseService,
        OtherHistoryService $otherHistoryService
    )
    {
        $this->patientRepository = $patientRepository;
        $this->recordRepository = $recordRepository;
        $this->medicalRecordRepository = $medicalRecordRepository;
        $this->pathologicalHistoryRepository = $pathologicalHistoryRepository;
        $this->exanthematicService = $exanthematicService;
        $this->chronicDegenerativeDiseaseService = $chronicDegenerativeDiseaseService;
        $this->otherHistoryService = $otherHistoryService;
    }

    public function getAllPatients()
    {
       return $this->patientRepository->all();
    }

    public function createPatient(array $data)
    {
        $this->patientRepository->create($data);
    }

    /**
     * @throws \Throwable
     */
    public function createFullPatient(array $patientData)
    {
        DB::beginTransaction();

        try {
            $patientCreated = $this->patientRepository->create($patientData);

            $recordCreated = $this->recordRepository->create([
                'patient_id' => $patientCreated->id,
            ]);

            $medicalRecordCreated = $this->medicalRecordRepository->create([
                'record_id' => $recordCreated->id,
            ]);

            $pathologicalHistoryCreated = $this->pathologicalHistoryRepository->create([
                'medical_record_id' => $medicalRecordCreated->id,
            ]);

            $this->exanthematicService->createExanthematic($pathologicalHistoryCreated->id);
            $this->chronicDegenerativeDiseaseService->createDegenerativeDiseaseRecord($pathologicalHistoryCreated->id);
            $this->otherHistoryService->createOtherHistoriesRecords($pathologicalHistoryCreated->id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception("Error al guardar los datos: " . $e->getMessage());
        }
    }

    public function updatePatient($id, array $data)
    {
        $this->patientRepository->update($id, $data);
    }

}
