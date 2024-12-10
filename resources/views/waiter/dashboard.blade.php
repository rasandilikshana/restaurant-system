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






    <div class="grid grid-cols-12 gap-4">
      <!-- First Grid -->
      <div class="col-span-12 md:col-span-6">
        <div class="grid grid-rows-4 gap-4">
          <div class="bg-gray-200 h-32">Row 1</div>
          <div class="bg-gray-300 h-32">Row 2</div>
          <div class="bg-gray-200 h-32">Row 3</div>
          <div class="bg-gray-300 h-32">Row 4</div>
        </div>
      </div>

      <!-- Second Grid -->
      <div class="col-span-12 md:col-span-6">
        <div class="grid grid-rows-4 gap-4">
          <div class="bg-gray-200 h-32">Row 1</div>
          <div class="bg-gray-300 h-32">Row 2</div>
          <div class="bg-gray-200 h-32">Row 3</div>
          <div class="bg-gray-300 h-32">Row 4</div>
        </div>
      </div>
    </div>
