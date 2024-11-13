<div x-data="{showNotification: false, message: ''}" x-show='showNotification' x-on:show-notification.window="
    showNotification = true; 
    message = $event.detail.message;
    setTimeout(() => showNotification = false, 2000);" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: none">

    <div x-show='showNotification' x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 transform transition-all">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div x-show='showNotification' x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="fixed rounded flex gap-4 justify-center items-center top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 min-w-72 min-h-40 px-8 py-5 bg-gradient-to-b from-[#41759D] to-[#0E2F5E] z-50">
        <p class="text-xl text-center text-white" x-text='message'></p>
        <i class=" fa-solid fa-check text-xl text-white bg-[#113059] aspect-square w-10 h-10 flex items-center
        justify-center rounded-full"></i>
    </div>
</div>