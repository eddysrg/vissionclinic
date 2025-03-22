<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<aside class="db-aside">
    <div class="db-aside__btn" id="aside-button">
        <i class="ri-menu-2-line"></i>
    </div>

    <div class="db-aside__logo-container">
        <picture>
            <source srcset="{{asset('images/ece_white_logo.avif')}}" type="image/avif">
            <source srcset="{{asset('images/ece_white_logo.webp')}}" type="image/webp">
            <img src="{{asset('images/ece_white_logo.png')}}" alt="Logo ECE">
        </picture>
    </div>

    <div class="db-aside__photo-container"></div>

    <nav>
        <ul class="db-aside__list">
            <li>
                <a href="{{route('dashboard')}}" class="db-aside__link">
                    <i class="ri-home-3-fill db-aside__link-icon"></i>
                    <span class="db-aside__link-text">Inicio</span>
                </a>
            </li>

            <li>
                <a href="{{route('dashboard.expedientes')}}" class="db-aside__link">
                    <i class="ri-group-fill db-aside__link-icon"></i>
                    <span class="db-aside__link-text">Expedientes</span>
                </a>
            </li>

            <li>
                <a href="{{route('dashboard.agenda')}}" class="db-aside__link">
                    <i class="ri-calendar-schedule-fill db-aside__link-icon"></i>
                    <span class="db-aside__link-text">Agenda</span>
                </a>
            </li>

            <li>
                <a href="{{route('dashboard.mvs')}}" class="db-aside__link">
                    <i class="ri-bar-chart-grouped-fill db-aside__link-icon"></i>
                    <span class="db-aside__link-text">Medical View System</span>
                </a>
            </li>

            <li>
                <a href="" class="db-aside__link">
                    <i class="ri-logout-box-r-line db-aside__link-icon"></i>
                    <span class="db-aside__link-text">Cerrar Sesión</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>