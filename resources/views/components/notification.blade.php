@props(['message'])

<div x-data="{showNotification: false}"
    x-on:show-notification.window="showNotification = true; setTimeout(() => showNotification = false, 3000);">

    <div x-show='showNotification' x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="fixed rounded flex flex-col gap-4 justify-center items-center top-14 right-2 w-72 h-40 bg-green-500 z-50"
        style="display: none">
        <i
            class="fa-solid fa-bell text-xl text-white bg-green-600 aspect-square w-10 h-10 flex items-center justify-center rounded-full"></i>
        <p class="text-xl text-center text-white">{{ $message }}</p>
    </div>
</div>