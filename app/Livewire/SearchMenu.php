<?php

namespace App\Livewire;

use Livewire\Component;

class SearchMenu extends Component
{
    public $query = '';
    public $categoriesWithMenuItems = [];

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
        $this->categoriesWithMenuItems = Category::with('menuItems')
            ->when($this->query, function ($queryBuilder) {
                $queryBuilder->where('name', 'like', '%' . $this->query . '%')
                    ->orWhereHas('menuItems', function ($menuItemQuery) {
                        $menuItemQuery->where('name', 'like', '%' . $this->query . '%');
                    });
            })
            ->get();
    }

    public function render()
    {
        return view('livewire.search-menu');
    }
}

