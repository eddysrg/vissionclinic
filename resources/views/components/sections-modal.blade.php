<div
    x-data="{sectionModal: false, sections: []}"
    x-show="sectionModal"
    x-on:section-modal.window="
    sectionModal = true;
    sections = $event.detail.sections;
    "
    class="fixed inset-0 flex justify-center items-center z-20" style="display: none">
    <div
        x-show="sectionModal"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="bg-gray-400 absolute inset-0 opacity-60" style="display: none"></div>

    <div
        x-show="sectionModal"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class=" relative bg-white z-20 w-2/6 h-2/5 flex flex-col items-center gap-3 rounded-2xl p-8" style="display: none">
        <i class="fa-solid fa-clipboard-check text-4xl text-red-400"></i>
        <p class="">Faltan las siguientes secciones por completar:</p>
        <ul>
            <template x-for="section in sections">
                <li class="list-disc text-red-500" x-text="section"></li>
            </template>
        </ul>

        <button type="button" x-on:click="sectionModal = false" class="w-8 h-8 aspect-square rounded-full bg-red-400 absolute top-5 right-5 flex justify-center items-center text-white cursor-pointer">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>


</div>
