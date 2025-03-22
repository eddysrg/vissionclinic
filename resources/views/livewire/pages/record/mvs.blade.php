<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Title, Layout};

new
#[Title('Medical View System - Vission Clinic ECE')]
#[Layout('layouts.app')]
class extends Component {
    //
}; ?>

<div class="p-8 bg-sky-100">
    <h1 class="text-2xl font-semibold text-[#174075] mb-5">Medical View System 📊</h1>

    <div class="grid grid-cols-4 gap-8">
        <div class="bg-[#40759C] text-white p-5 rounded-md shadow-lg flex flex-col items-center justify-center">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-users text-2xl text-cyan-200"></i>
                <h3 class="text-xl text-center mb-2 font-semibold">Pacientes Activos</h3>
            </div>
            <p class="text-center text-3xl font-bold text-cyan-200">1,230</p>
        </div>

        <div class="bg-[#40759C] text-white p-5 rounded-md shadow-lg flex flex-col items-center justify-center">
            <div class="flex items-center gap-3">
                <i class="text-cyan-200 fa-solid fa-calendar-days text-2xl"></i>
                <h3 class="text-xl text-center mb-2 font-semibold">Citas Hoy</h3>
            </div>
            <p class="text-cyan-200 text-center text-3xl font-bold">45</p>
        </div>

        <div class="bg-[#40759C] text-white p-5 rounded-md shadow-lg flex flex-col items-center justify-center">
            <div class="flex items-center gap-3">
                <i class="text-cyan-200 fa-solid fa-user-doctor text-2xl"></i>
                <h3 class="text-xl text-center mb-2 font-semibold">Consultas en el mes</h3>
            </div>
            <p class="text-cyan-200 text-center text-3xl font-bold">320</p>
        </div>

        <div class="bg-[#40759C] text-white p-5 rounded-md shadow-lg flex flex-col items-center justify-center">
            <div class="flex items-center gap-3">
                <i class="text-cyan-200 fa-solid fa-hospital text-2xl"></i>
                <h3 class="text-xl text-center mb-2 font-semibold">Referencias Médicas</h3>
            </div>
            <p class="text-cyan-200 text-center text-3xl font-bold">12</p>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-8 mt-8">
        <div class="bg-[#f9f9f9] rounded-md shadow-xl p-5">
            <h2 class="text-xl font-semibold mb-5">📈 Consultas por Mes</h2>

            <canvas id="consultasChart"></canvas>
        </div>

        <div class="bg-[#f9f9f9] rounded-md shadow-xl p-5">
            <h2 class="text-xl font-semibold mb-5">📊 Promedio de enfermedades</h2>

            <canvas id="enfermedadesChart"></canvas>
        </div>
    </div>

    <div class="grid mt-8">
        <div class="bg-[#f9f9f9] rounded-md shadow-xl p-5">
            <h2 class="text-xl font-semibold text-center mb-5">⚧️ Distribución de Género</h2>

            <div class="w-80 mx-auto">
                <canvas id="generoChart"></canvas>
            </div>
        </div>
    </div>
</div>

@script
<script>
    document.addEventListener('livewire:initialized', function() {
        const ctxConsultas = document.getElementById('consultasChart').getContext('2d');
        new Chart(ctxConsultas, {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Consultas',
                    data: [30, 50, 40, 60, 80, 100, 90, 70, 60, 110, 120, 140],
                    borderColor: 'blue',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: { responsive: true }
        });

        // Gráfico de enfermedades
        const ctxEnfermedades = document.getElementById('enfermedadesChart').getContext('2d');
        new Chart(ctxEnfermedades, {
            type: 'bar',
            data: {
                labels: ['Diabetes', 'hipertensión', 'Obesidad', 'EPOC', 'Depresión'],
                datasets: [{
                    label: 'Pacientes Atendidos',
                    data: [120, 150, 90, 100, 130],
                    backgroundColor: ['red', 'green', 'blue', 'orange', 'purple']
                }]
            },
            options: { responsive: true }
        });

        const ctxGenero = document.getElementById('generoChart').getContext('2d');
        new Chart(ctxGenero, {
            type: 'pie',
            data: {
                labels: ['Masculino', 'Femenino', 'Otro'],
                datasets: [{
                    label: 'Distribución de Género',
                    data: [500, 700, 30],
                    backgroundColor: ['#3498db', '#e74c3c', '#f1c40f']
                }]
            },
            options: { responsive: true }
        });
    });
</script>
@endscript
