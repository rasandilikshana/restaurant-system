<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class SearchMenu extends Component
{
    public $query = '';
    public $categoriesWithMenuItems = [];
    public $quantities = [];
    public $cart = [];
    public $openedCategory = null; // Keeps track of the currently opened category

    public function mount()
    {
        $this->loadCategories();
    }

    public function updatedQuery()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categoriesWithMenuItems = Category::select('id', 'name')
            ->with(['menuItems' => function ($query) {
                $query->select('id', 'name', 'category_id')
                    ->when($this->query, function ($q) {
                        $q->where('name', 'like', '%' . $this->query . '%');
                    });
            }])
            ->when($this->query, function ($q) {
                $q->where('name', 'like', '%' . $this->query . '%')
                    ->orWhereHas('menuItems', function ($menuItemQuery) {
                        $menuItemQuery->where('name', 'like', '%' . $this->query . '%');
                    });
            })
            ->get();

        // Initialize quantities for all menu items
        foreach ($this->categoriesWithMenuItems as $category) {
            foreach ($category->menuItems as $item) {
                if (!isset($this->quantities[$item->id])) {
                    $this->quantities[$item->id] = 0;
                }
            }
        }
    }

    public function incrementQuantity($itemId)
    {
        $this->quantities[$itemId]++;
        $this->updateCart($itemId);
    }

    public function decrementQuantity($itemId)
    {
        if ($this->quantities[$itemId] > 0) {
            $this->quantities[$itemId]--;
        }

        // Remove from cart if quantity becomes 0
        $this->updateCart($itemId);
    }

    private function updateCart($itemId)
    {
        foreach ($this->categoriesWithMenuItems as $category) {
            foreach ($category->menuItems as $item) {
                if ($item->id === $itemId) {
                    if ($this->quantities[$itemId] > 0) {
                        // Add or update the item in the cart
                        $this->cart[$itemId] = [
                            'name' => $item->name,
                            'quantity' => $this->quantities[$itemId],
                            'id' => $item->id,
                        ];
                    } else {
                        // Remove the item from the cart
                        unset($this->cart[$itemId]);
                    }
                }
            }
        }
    }

    public function placeOrder()
    {
        if (empty($this->cart)) {
            session()->flash('error', 'No items selected to place the order.');
        } else {
            // Pass the cart items to the session for use in the order summary
            session()->put('cart', $this->cart);

            return redirect()->route('order.summary');
        }
    }

    public function toggleCategory($categoryId)
    {
        $this->openedCategory = $this->openedCategory === $categoryId ? null : $categoryId;
    }



    public function render()
    {
        return view('livewire.search-menu');
    }
}
