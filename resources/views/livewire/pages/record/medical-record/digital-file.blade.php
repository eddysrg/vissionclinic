<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use Livewire\WithFileUploads;
use App\Models\{Patient, DigitalFile};
use Illuminate\View\View;



new
#[Title('Archivo Digital - Vission Clinic ECE')]
class extends Component {
    use WithFileUploads;

    public $patient;

    public $files = []; // Array para almacenar múltiples archivos
    public $fileInfos = []; // Array para almacenar información de los archivos
    public $showSaveButton = false;
    public $savedFiles = [];

    public function updatedFiles()
    {
        // Validar los archivos
        $this->validate([
            'files.*' => 'required|file|max:1024', // Máximo 1MB por archivo
        ]);

        // Obtener información de cada archivo
        foreach ($this->files as $file) {
            $this->fileInfos[] = [
                'name' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'size' => round($file->getSize() / 1024, 2) . ' KB',
            ];
        }
    }

    public function save()
    {

        if(empty($this->files)) {
            session()->flash('error-message', 'No se han seleccionado archivos.');
            return;
        }

        // Guardar cada archivo en el sistema de archivos
        foreach ($this->files as $file) {
            $path = $file->store('uploads');

            DigitalFile::create([
                'medical_record_sections_id' => $this->medicalRecordSectionId,
                'name' => $file->getClientOriginalName(),
                'path' => $path,
                'extension' => $file->getClientOriginalExtension(),
                'size' => round($file->getSize() / 1024, 2) . ' KB',
            ]);
        }

        // Resetear el formulario
        $this->reset(['files', 'fileInfos', 'showSaveButton']);

        // Mostrar mensaje de éxito
        session()->flash('success-message', 'Archivos subidos correctamente.');
    }

    public function deleteFile($id)
    {
        $file = DigitalFile::find($id);
        $file->delete();

        session()->flash('success-message', 'Archivo eliminado correctamente.');
    }

    public function mount($id)
    {
        $this->patient = Patient::find($id);

    }

    public function rendering(View $view)
    {
        $view
            ->layout('components.layout.record', [
                'patient' => $this->patient,
                'hasAppointment' => !$this->patient->appointments->isEmpty(),
            ]);
    }
}; ?>

<div
    x-on:medicine-alert.window="alert($event.detail.message)" >


    <x-record-notification/>

    {{-- Start of component --}}

    <h2 class="text-3xl text-[#174075]">Archivo digital(Anexos)</h2>

    @if (session()->has('error-message'))
        <div class="mt-3">
            <p class="bg-red-200 border border-red-500 text-center text-red-700">
                {{session('error-message')}}
            </p>
        </div>
    @elseif (session()->has('success-message'))
        <div class="mt-3">
            <p class="bg-green-200 border border-green-500 text-center text-green-700">
                {{session('success-message')}}
            </p>
        </div>
    @endif



    <section class="grid grid-cols-2 gap-3 mt-5">

        <div class="h-60 overflow-scroll border border-gray-300">
            <table class="w-full border-collapse bg-white">
                <thead class="border-b border-gray-300">
                    <tr>
                        <th class="p-2">Fecha</th>
                        <th class="p-2">Archivo</th>
                        <th class="p-2">Acción</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($savedFiles as $file)
                        <tr>
                            <td class="text-sm p-2 text-center">{{$file->created_at->format('d/m/Y')}}</td>
                            <td class="text-sm p-2 text-center text-[#41759D] cursor-pointer">{{$file->name}}</td>
                            <td class="text-sm p-2 text-center">
                                <button wire:click="deleteFile({{$file->id}})" wire:confirm='¿Desea eliminar el archivo?' class="text-red-500">
                                    <i class="fa-solid fa-circle-xmark text-red-500"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-sm p-2 text-center"></td>
                            <td class="text-sm p-2 text-center text-[#41759D] cursor-pointer">Aún no hay archivos</td>
                            <td class="text-sm p-2 text-center"></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-col gap-2 h-60">
            <div class="border border-dashed border-black text-center">
                <input type="file" accept=".pdf" wire:model="files" id="fileInput" multiple class="hidden">
                <button type="button" onclick="document.getElementById('fileInput').click()" class="text-sm  text-[#41759D]">
                    Selecciona desde tu computadora
                </button>
            </div>

            <div class="bg-white h-full border border-gray-300 overflow-scroll">
                @foreach ($fileInfos as $info)
                    <div class="bg-gray-200 py-2 flex items-center justify-center gap-5">
                        <p class="text-sm flex items-center justify-center gap-3 text-[#174075] font-semibold">
                            <i class="fa-solid fa-file"></i>
                            {{$info['name']}}
                        </p>

                        <p class="text-sm font-semibold">{{$info['size']}}</p>
                    </div>
                @endforeach
            </div>
        </div>

    </section>

    <div class="flex justify-end">
        <button wire:click='save' class="bg-[#174075] text-white px-5 py-2 rounded-md mt-5">
            Guardar archivos
        </button>
    </div>



    {{-- End of component --}}
</div>
