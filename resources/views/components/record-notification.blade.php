<div
    x-data="{showNoti: false, message: '', link: ''}"
    x-show="showNoti"
    x-on:show-noti.window="
    showNoti = true;
    message = $event.detail.message;
    setTimeout(() => {
    showNoti = false;
    window.location.replace($event.detail.link);
    }, 2000);"
    class="fixed inset-0 flex justify-center items-center z-20" style="display: none">
    <div x-show="showNoti"
         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="bg-gray-400 absolute inset-0 opacity-60" ></div>

    <div x-show="showNoti"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="bg-[#174075] z-20 w-2/6 h-2/5 flex flex-col justify-center items-center gap-3 rounded-2xl text-white">
        <i class="fa-solid fa-clipboard-check text-4xl"></i>
        <p class="text-xl" x-text="message"></p>
    </div>
</div>
