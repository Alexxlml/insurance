<div>
    <div class="py-4 px-6 @if($switchCotizacion == true) hidden @else @endif">
        <form wire:submit.prevent="checkToken" class="space-y-8 divide-y divide-gray-200">
            <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">

                <div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Formulario de cotización</h3>
                    </div>
                    <div class="space-y-6 sm:space-y-5">

                        <div
                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="country" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                Paquete
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <select wire:model.lazy="paquete" id="country" name="country"
                                    autocomplete="country-name"
                                    class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                    <option></option>
                                    <option value="12111">Viajero con asistencia (salida)</option>
                                </select>
                                @error('paquete') <p class="mt-1 mb-1 text-xs text-red-600 italic">
                                    {{ $message }}
                                </p> @enderror
                            </div>
                        </div>

                        <div
                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="country" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Plan
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <select wire:model.lazy="plan" id="country" name="country" autocomplete="country-name"
                                    class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                    <option></option>
                                    <option value="0000">Básico</option>
                                    <option value="0010">Plus</option>
                                </select>
                                @error('plan') <p class="mt-1 mb-1 text-xs text-red-600 italic">
                                    {{ $message }}
                                </p> @enderror
                            </div>
                        </div>

                        <div
                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="street-address"
                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                Inicio del viaje </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <input wire:model.lazy="inicio_viaje" type="date" name="street-address"
                                    id="street-address" autocomplete="street-address"
                                    class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                @error('inicio_viaje') <p class="mt-1 mb-1 text-xs text-red-600 italic">
                                    {{ $message }}
                                </p> @enderror
                            </div>
                        </div>

                        <div
                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="street-address"
                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                Fin del viaje </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <input wire:model.lazy="fin_viaje" type="date" name="street-address" id="street-address"
                                    autocomplete="street-address"
                                    class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                @error('fin_viaje') <p class="mt-1 mb-1 text-xs text-red-600 italic">
                                    {{ $message }}
                                </p> @enderror
                            </div>
                        </div>

                        <div
                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="first-name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                Primer
                                nombre </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <input wire:model.lazy="nombre_1" type="text" name="first-name" id="first-name"
                                    autocomplete="given-name"
                                    class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                @error('nombre_1') <p class="mt-1 mb-1 text-xs text-red-600 italic">
                                    {{ $message }}
                                </p> @enderror
                            </div>
                        </div>

                        <div
                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="first-name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                Segundo nombre</label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <input wire:model.lazy="nombre_2" type="text" name="first-name" id="first-name"
                                    autocomplete="given-name"
                                    class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                @error('nombre_2') <p class="mt-1 mb-1 text-xs text-red-600 italic">
                                    {{ $message }}
                                </p> @enderror
                            </div>
                        </div>

                        <div
                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="last-name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                Primer
                                apellido </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <input wire:model.lazy="apellido_1" type="text" name="last-name" id="last-name"
                                    autocomplete="family-name"
                                    class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                @error('apellido_1') <p class="mt-1 mb-1 text-xs text-red-600 italic">
                                    {{ $message }}
                                </p> @enderror
                            </div>
                        </div>

                        <div
                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="last-name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                Segundo
                                apellido </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <input wire:model.lazy="apellido_2" type="text" name="last-name" id="last-name"
                                    autocomplete="family-name"
                                    class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                @error('apellido_2') <p class="mt-1 mb-1 text-xs text-red-600 italic">
                                    {{ $message }}
                                </p> @enderror
                            </div>
                        </div>

                        <div
                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="street-address"
                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                Fecha de nacimiento </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <input wire:model.lazy="fecha_nacimiento" type="date" name="street-address"
                                    id="street-address" autocomplete="street-address"
                                    class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                @error('fecha_nacimiento') <p class="mt-1 mb-1 text-xs text-red-600 italic">
                                    {{ $message }}
                                </p> @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <button type="submit"
                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cotizar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="@if($switchCotizacion != true) hidden @else flex @endif flex-col w-full text-center mt-4">
        <h2 class="text-2xl font-bold text-gray-800">Cotización</h2>
        <div class="text-left">
            @if ($switchCotizacion == true)
            <p class="mt-2">Número de cotización: {{ $responseCotizacion['numeroCotizacion'] }}</p>
            <p class="mt-2">Moneda: {{ $responseCotizacion['descripcionMoneda'] }}</p>
            <p class="mt-2">Monto anual: {{ $responseCotizacion['primas']['0']['montoPrima'] }}</p>
            @endif
        </div>

        <div class="mt-4">
            <div class="mt-4">
                <h3 class="text-xl font-bold text-gray-800">Coberturas</h3>
            </div>
            <div class="grid grid-cols-3 gap-4">
                @if ($switchCotizacion == true)
                @foreach ($responseCotizacion['coberturas'] as $cobertura)
                <div class="col-span-1 p-4 drop-shadow-lg rounded bg-blue-300">
                    <div class="flex flex-col items-start">
                        <p>Descripción: {{ $cobertura['descripcion'] }}</p>
                        <p>Monto asegurado: {{ $cobertura['montoAsegurado'] }}</p>
                        <p>Prima: {{ $cobertura['prima'] }}</p>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <div class="flex justify-end mt-4">
                <button wire:click="backToForm" type="button"
                    class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Regresar</button>
            </div>
        </div>

    </div>
</div>