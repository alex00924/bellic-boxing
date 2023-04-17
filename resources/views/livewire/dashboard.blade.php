<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @livewire('search-fight')
    @can('match-maker')
        @livewire('create-fight')
    @endcan
</div>
