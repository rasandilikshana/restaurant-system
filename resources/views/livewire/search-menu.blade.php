<div class="p-6">
    <div class="mb-6">
        <input
            type="text"
            wire:model.debounce.300ms="query"
            placeholder="Search categories or menu items..."
            class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
        >
    </div>

    <div>
        @foreach($categoriesWithMenuItems as $category)
            <div class="border-b mb-4">
                <button
                    onclick="toggleCategory('category-{{ $category->id }}')"
                    class="w-full text-left p-4 bg-gray-200 hover:bg-gray-300 rounded-t focus:outline-none"
                >
                    <span class="font-bold">{{ $category->name }}</span>
                </button>

                <!-- Menu Items List (Initially Hidden) -->
                <div id="category-{{ $category->id }}" class="hidden p-4 bg-gray-100">
                    @if($category->menuItems->count())
                        <ul class="list-disc pl-4">
                            @foreach($category->menuItems as $item)
                                <li class="py-1">{{ $item->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">No menu items available.</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    function toggleCategory(id) {
        const element = document.getElementById(id);
        element.classList.toggle('hidden');
    }
</script>
