<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $roleId = auth()->user()->role_id;

        //Chef
        if ($roleId == 3) {
            return view('chef.dashboard');
        }
        //Waiter
        else  if ($roleId == 4) {
            $menuData = $this->getMenuDataCollection();
            return view('waiter.dashboard', compact('menuData'));
        }
        //Cashier
        else if ($roleId == 5) {
            return view('cashier.dashboard');

        } else if ($roleId == 1) {
            return redirect('/admin/login');

        } else {
            abort(403);
        }
    }

    public function getMenuData(Request $request)
    {
        $query = $request->input('query');
        return $this->getMenuDataCollection($query);
    }

    protected function getMenuDataCollection($query = null)
    {
        $categoriesWithMenuItems = Category::with('menuItems')
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'like', '%' . $query . '%')
                    ->orWhereHas('menuItems', function ($menuItemQuery) use ($query) {
                        $menuItemQuery->where('name', 'like', '%' . $query . '%');
                    });
            })
            ->get();

        return $categoriesWithMenuItems;
    }

    public function orderSummary()
    {

        $cart = Session::get('cart');
        return view('waiter.order-summary', compact('cart'));
    }
}
