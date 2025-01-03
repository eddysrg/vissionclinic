<?php

namespace App\Livewire;

use App\Models\Diagnosis;
use Livewire\Component;

class DiagnosisOfDiseases extends Component
{

    public $searchInput = '';
    public $results = [];
    public $selectedDiagnoses = [];
    public $newCase = [];

    public function search()
    {
        if($this->searchInput === '') {
            $this->cleanSearch();
            return;
        }

        $diagnoses = Diagnosis::where('name', 'like', '%' . $this->searchInput . '%')->get();

        if($diagnoses->count() > 0) {
            $this->results = $diagnoses;
        } else {
            $this->results = [];
        }
    }

    public function updatedSearchInput()
    {
        $this->results = Diagnosis::where('name', 'like', '%' . $this->searchInput . '%')->get();
    }

    public function addDiagnosis($id)
    {
        if (!isset($this->newCase[$id])) {
            $this->dispatch('validationFailed');
            return;
        }

        $diagnosis = Diagnosis::find($id);

        if($diagnosis && !collect($this->selectedDiagnoses)->pluck('id')->contains($diagnosis->id)) {
            $this->selectedDiagnoses[] = [
                'id' => $diagnosis->id,
                'catalog_key' => $diagnosis->catalog_key,
                'name' => $diagnosis->name,
                'form' => 'Capturar formulario',
                'newCase' => $this->newCase[$id],
                'study' => $diagnosis->require_epi_study,
                'status' => 'Estudio llenado',
            ];
        }
    }

    public function removeDiagnosis($id)
    {
        $this->selectedDiagnoses = collect($this->selectedDiagnoses)->reject(fn($item) => $item['id'] === $id)->toArray();
    }

    public function cleanSearch()
    {
        $this->searchInput = '';
        $this->results = [];
    }


    public function mount()
    {
        // $this->diagnosesInfo = session()->get('cart', []);
        
        // session()->forget('cart');
    }

    public function render()
    {
        return view('livewire.diagnosis-of-diseases');
    }
}
