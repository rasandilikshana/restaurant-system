<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div>
    <div class="container mx-auto mt-10">
        @livewire('search-menu')
    </div>





        <h3>Welcome, Waiter!</h3>
        <p>This is the dashboard content for Waiters.</p>
    </div>

</x-app-layout>




