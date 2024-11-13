<x-app-layout>
    <x-notification />
    <div class="p-8">
        @livewire('profile.update-photo')
        @livewire('profile.update-profile-information-form')
        @livewire('profile.update-login')
    </div>
    <x-notification />
</x-app-layout>