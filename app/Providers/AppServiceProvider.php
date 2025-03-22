<?php

namespace App\Providers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Repositories\AppointmentRepository;
use App\Repositories\ChronicDegenerativeDiseaseRepository;
use App\Repositories\ExanthematicRepository;
use App\Repositories\MedicalRecordRepository;
use App\Repositories\OtherHistoryRepository;
use App\Repositories\PathologicalHistoryRepository;
use App\Repositories\PatientRepository;
use App\Repositories\RecordRepository;
use App\Services\AppointmentService;
use App\Services\ChronicDegenerativeDiseaseService;
use App\Services\ExanthematicService;
use App\Services\OtherHistoryService;
use App\Services\PatientService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PatientRepository::class, function($app) {
            return new PatientRepository($app->make(Patient::class));
        });

        $this->app->bind(AppointmentRepository::class, function($app) {
            return new AppointmentRepository($app->make(Appointment::class));
        });

        $this->app->bind(ExanthematicService::class, function($app) {
            return new ExanthematicService($app->make(ExanthematicRepository::class));
        });

        $this->app->bind(ChronicDegenerativeDiseaseService::class, function($app) {
            return new ChronicDegenerativeDiseaseService($app->make(ChronicDegenerativeDiseaseRepository::class));
        });

        $this->app->bind(OtherHistoryService::class, function($app) {
            return new OtherHistoryService($app->make(OtherHistoryRepository::class));
        });

        $this->app->bind(PatientService::class, function($app) {
            return new PatientService(
                $app->make(PatientRepository::class),
                $app->make(RecordRepository::class),
                $app->make(MedicalRecordRepository::class),
                $app->make(PathologicalHistoryRepository::class),
                $app->make(ExanthematicService::class),
                $app->make(ChronicDegenerativeDiseaseService::class),
                $app->make(OtherHistoryService::class),
            );
        });

        $this->app->bind(AppointmentService::class, function($app) {
            return new AppointmentService($app->make(AppointmentRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
