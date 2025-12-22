<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalhes Pokémon') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <b>Name:</b> {{mb_strtoupper($pokemon["name"])}}<br>
                    <b>Height:</b> {{$pokemon["height"]}}<br>
                    <b>Weight:</b> {{$pokemon["weight"]}}<br>
                    <b>Thumbnail:</b>
                    <img src="{{$pokemon['sprites']->other->dream_world->front_default}}" width="200" height="200">
                    <br>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
