@extends('record.record')

@section('content')
<h2 class="text-3xl text-[#174075]">Ficha de identificación</h2>

<div class="mt-8">
    <form>
        <section class="grid grid-cols-5 gap-5">
            <div class="flex flex-col">
                <label for="name" class="uppercase text-xs">Nombre</label>
                <input type="text" name="name" id="name" autocomplete="name" class="rounded text-sm p-1">
            </div>

            <div class="flex flex-col">
                <label for="father_last_name" class="uppercase text-xs">Primer Apellido</label>
                <input type="text" name="father_last_name" id="father_last_name" class="rounded text-sm p-1">
            </div>

            <div class="flex flex-col">
                <label for="mother_last_name" class="uppercase text-xs">Segundo Apellido</label>
                <input type="text" name="mother_last_name" id="mother_last_name" class="rounded text-sm p-1">
            </div>

            <div class="flex flex-col">
                <label for="gender" class="uppercase text-xs">Sexo</label>
                <select name="gender" id="gender" class="rounded text-sm p-1">
                </select>
            </div>

            <div class="flex flex-col">
                <label for="gender_identity" class="uppercase text-xs">Identidad de género</label>
                <select name="gender_identity" id="gender_identity" class="rounded text-sm p-1">
                </select>
            </div>

            <div class="flex flex-col">
                <label for="age" class="uppercase text-xs">Edad</label>
                <input type="text" name="age" id="age" class="rounded text-sm p-1">
            </div>

            <div class="flex flex-col">
                <label for="birthdate" class="uppercase text-xs">Fecha de nacimiento</label>
                <input type="date" name="birthdate" id="birthdate" class="rounded text-sm p-1">
            </div>

            <div class="flex flex-col">
                <label for="birthplace" class="uppercase text-xs">Lugar de nacimiento</label>
                <select name="birthplace" id="birthplace" class="rounded text-sm p-1">
                </select>
            </div>
        </section>

        <section class="mt-10">
            <h3 class="text-2xl text-[#174075]">Domicilio</h2>

                <div class="grid grid-cols-4 gap-5 mt-5">
                    <div class="flex flex-col">
                        <label for="country" class="uppercase text-xs">País</label>
                        <select name="country" id="country" autocomplete="country" class="rounded text-sm p-1"></select>
                    </div>

                    <div class="flex flex-col">
                        <label for="state" class="uppercase text-xs">Estado</label>
                        <select name="state" id="state" class="rounded text-sm p-1"></select>
                    </div>

                    <div class="flex flex-col">
                        <label for="zip_code" class="uppercase text-xs">Código postal</label>
                        <select name="zip_code" id="zip_code" class="rounded text-sm p-1"></select>
                    </div>

                    <div class="flex flex-col">
                        <label for="neighborhood" class="uppercase text-xs">Colonia</label>
                        <select name="neighborhood" id="neighborhood" class="rounded text-sm p-1"></select>
                    </div>

                    <div class="flex flex-col col-span-3">
                        <label for="street" class="uppercase text-xs">Calle</label>
                        <input type="text" name="street" id="street" class="rounded text-sm p-1">
                    </div>

                    <div class="flex flex-col">
                        <label for="house_number" class="uppercase text-xs">Número</label>
                        <input type="text" name="house_number" id="house_number" class="rounded text-sm p-1">
                    </div>
                </div>
        </section>

        <section class="mt-10">
            <h3 class="text-2xl text-[#174075]">Otros datos</h2>

                <div class="grid grid-cols-4 gap-5 mt-5">
                    <div class="flex flex-col">
                        <label for="religion" class="uppercase text-xs">Religión</label>
                        <select name="religion" id="religion" class="rounded text-sm p-1"></select>
                    </div>

                    <div class="flex flex-col">
                        <label for="education" class="uppercase text-xs">Escolaridad</label>
                        <select name="education" id="education" class="rounded text-sm p-1"></select>
                    </div>

                    <div class="flex flex-col">
                        <label for="occupation" class="uppercase text-xs">Ocupación</label>
                        <input type="text" name="occupation" id="occupation" class="rounded text-sm p-1">
                    </div>

                    <div class="flex flex-col">
                        <label for="marital_status" class="uppercase text-xs">Estado civil</label>
                        <select name="marital_status" id="marital_status" class="rounded text-sm p-1"></select>
                    </div>

                    <div class="flex flex-col">
                        <label for="landline" class="uppercase text-xs">Teléfono fijo</label>
                        <input type="tel" id="landline" class="rounded text-sm p-1">
                    </div>

                    <div class="flex flex-col">
                        <label for="cellphone" class="uppercase text-xs">Teléfono movil</label>
                        <input type="tel" name="cellphone" id="cellphone" class="rounded text-sm p-1">
                    </div>

                    <div class="flex flex-col col-span-2">
                        <label for="email" class="uppercase text-xs">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="rounded text-sm p-1">
                    </div>

                    <div class="flex flex-col col-span-2">
                        <label for="parent" class="uppercase text-xs">Responsable legal, padre o
                            tutor</label>
                        <input type="text" name="parent" id="parent" class="rounded text-sm p-1">
                    </div>

                    <div class="flex flex-col">
                        <label for="parent_phone" class="uppercase text-xs">Teléfono responsable</label>
                        <input type="text" name="parent_phone" id="parent_phone" class="rounded text-sm p-1">
                    </div>

                    <div class="flex flex-col">
                        <label for="relationship" class="uppercase text-xs">Parentesco</label>
                        <input type="text" name="relationship" id="relationship" class="rounded text-sm p-1">
                    </div>

                    <div class="flex flex-col">
                        <label for="interrogation" class="uppercase text-xs">Interrogatorio</label>
                        <select name="interrogation" id="interrogation" class="rounded text-sm p-1">
                        </select>
                    </div>
                </div>
        </section>

        <div class="flex items-center justify-end mt-8">
            <div class="flex gap-3">
                <button class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Siguiente
                </button>

                <button class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Imprimir
                </button>

                <button class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Guardar
                </button>
            </div>
        </div>
    </form>
</div>


@endsection