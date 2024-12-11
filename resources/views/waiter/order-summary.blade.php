<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Summary') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Order Summary</h2>

        @if ($cart)
            <div>
                @foreach ($cart as $itemId => $item)
                    <div class="flex justify-between items-center border-b py-2">
                        <span>{{ $item['name'] }}</span>
                        <div class="flex items-center space-x-4">
                            <button wire:click="decrementQuantity({{ $itemId }})" class="bg-red-500 text-white px-2 py-2 rounded hover:bg-red-600">-</button>
                            <span>{{ $item['quantity'] }}</span>
                            <button wire:click="incrementQuantity({{ $itemId }})" class="bg-blue-500 text-white px-2 py-2 rounded hover:bg-blue-600">+</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                <h3 class="font-bold">Available Offers</h3>
                <button class="bg-blue-500 text-white px-4 py-2 rounded mt-2 hover:bg-blue-600">
                    Apply 10% Discount
                </button>
            </div>

            <div class="mt-6 p-4 bg-gray-50 rounded shadow">
                <h3 class="font-bold">Final Summary</h3>
                <p>Total Items: {{ array_sum(array_column($cart, 'quantity')) }}</p>
                <p class="text-green-500">Grand Total: $<span id="grand-total">123</span></p>
            </div>
        @else
            <p>No items in the order.</p>
        @endif
    </div>

</x-app-layout>


1.) in case waiter need to add more products, the cart session variable should be sent to the dashvboard page and displayed in the order summary page..
2.) load available consenssions to here
3.) if the user click on the consession ti should be applied and final toatl and sumamry should be updated
4.) if the user click on the place order button, the order should be placed and the cart session variable should be cleared
5.) user can increase, descrease and remove items from the cart
