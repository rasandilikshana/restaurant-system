<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Dynamic content based on role --}}
                    @if(Auth::user()->role->name === 'Waiter')
                        @include('waiter.dashboard')
                    @elseif(Auth::user()->role->name === 'Cashier')
                        @include('cashier.dashboard')
                    @elseif(Auth::user()->role->name === 'Chef')
                        @include('chef.dashboard')
                    @elseif(Auth::user()->role->name === 'Admin')
                        <p>{{ __("Welcome Admin!") }}</p>
                    @else
                        <p>{{ __("Role not assigned!") }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
