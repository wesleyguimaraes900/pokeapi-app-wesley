<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listagem') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="GET" action="/busca">

                        @csrf

                        <div>
                            <x-input-label for="nomePoke" :value="__('Busca por Nome')" />
                            <x-text-input id="nomePoke" class="mt-1 w-[40px]"
                                type="text" name="nomePoke" autofocus autocomplete="Nome do Pokémon" />

                            <x-primary-button class="ms-3">
                                {{ __('Buscar') }}
                            </x-primary-button>

                        </div>

                    </form>

                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <table class="w-full table-auto border-collapse text-sm">

                        <thead>
                            <tr>
                                <th class="border border-gray-200 p-4 pt-0 pb-3 pl-8 text-left font-medium text-gray-400 dark:border-gray-600 dark:text-gray-200">Nome</th>
                                <th colspan="2" class="border border-gray-200 p-4 pt-0 pb-3 pl-8 text-left font-medium text-gray-400 dark:border-gray-600 dark:text-gray-200">Detalhes</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-700">

                            @if( isset($pokemons["count"]) && $pokemons["count"] > 0)

                                @foreach($pokemons["results"] as $poke)

                                    <tr>
                                        <td class="border border-gray-200 p-4 pl-8
                                            text-gray-500 dark:border-gray-600 dark:text-gray-400"
                                            style="text-align:center;">
                                            <b>{{mb_strtoupper($poke->name)}}</b>
                                        </td>
                                        <td class="border border-gray-200 p-4 pl-8
                                            text-gray-500 dark:border-gray-600 dark:text-gray-400"
                                            style="text-align:center;">
                                            Detalhes
                                        </td>
                                        <td class="border border-gray-200 p-4 pl-8
                                            text-gray-500 dark:border-gray-600 dark:text-gray-400"
                                            style="text-align:center;">
                                            Importar
                                        </td>
                                    </tr>

                                @endforeach

                            @else

                                <tr>
                                    <td colspan="3" align="center"
                                        class="border border-gray-200 p-4 pl-8
                                            text-gray-500 dark:border-gray-600 dark:text-gray-400"
                                            style="text-align:center;">

                                        NENHUM DADO ENCONTRADO

                                    </td>
                                </tr>

                            @endif

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
