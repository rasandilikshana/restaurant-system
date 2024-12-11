<div class="p-6">
    <div class="mb-8 flex justify-end">
        <button wire:click="placeOrder"
            class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300">
            Continue to Place the Order
        </button>
    </div>
    <div>
        @if (session()->has('error'))
            <p class="text-red-500">{{ session('error') }}</p>
        @endif
    </div>
    <div class="mb-6 mt-4">
        <input type="text" wire:model.defer="query" placeholder="Search categories or menu items..."
            class="w-full p-2 border rounded focus:ring focus:ring-blue-300">
    </div>

    <div>
        @foreach ($categoriesWithMenuItems as $category)
            <div class="border-b mb-4">
                <button wire:click="$set('openedCategory', {{ $category->id }})"
                    class="w-full p-4 bg-gray-200 text-left">
                    <strong>{{ $category->name }}</strong>
                </button>

                @if ($openedCategory === $category->id)
                    <div class="p-4 bg-gray-50 grid grid-cols-4 gap-4">
                        @foreach ($category->menuItems as $item)
                            <div
                                class="bg-white shadow-md rounded p-4 text-center hover:shadow-lg transition duration-200">
                                <!-- Menu Item Image -->
                                @if ($item->image)
                                    <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->name }}"
                                        class="h-32 w-full object-cover rounded mb-2">
                                @else
                                    <div class="h-32 w-full bg-gray-200 rounded flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif

                                <!-- Menu Item Name -->
                                <h3 class="font-semibold mb-2">{{ $item->name }}</h3>
                                <div class="text-gray-500 mb-2">${{ number_format($item->price, 2) }}</div>

                                <!-- Quantity Controls -->
                                <div class="flex justify-center items-center space-x-2">
                                    <button wire:click="decrementQuantity({{ $item->id }})"
                                        class="bg-red-500 text-white px-4 py-3 rounded hover:bg-red-600">
                                        -
                                    </button>
                                    <span class="text-lg font-semibold">{{ $quantities[$item->id] ?? 0 }}</span>
                                    <button wire:click="incrementQuantity({{ $item->id }})"
                                        class="bg-blue-500 text-white px-4 py-3 rounded hover:bg-blue-600">
                                        +
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
