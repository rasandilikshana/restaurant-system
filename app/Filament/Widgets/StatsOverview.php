<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Order;
use App\Models\Concession;
use App\Models\MenuItem;
use App\Models\StaffMember;
use Carbon\Carbon;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 0;


    protected function getStats(): array
    {

        // Pending Orders
        $pendingOrders = Order::where('status', 'Pending')->count();

        // Completed Orders
        $completedOrders = Order::where('status', 'Completed')->count();

        // Total Concessions
        $totalConcessions = Concession::count();

        // Total Menu Items
        $totalMenuItems = MenuItem::count();

        // Total Staff Members
        $totalStaffMembers = StaffMember::count();
        $totalRevenue = Order::sum('total_amount');
        $ordersToday = Order::whereDate('created_at', Carbon::today())->count();

        // Return the stats in a structured format
        return [
            Stat::make('Total Revenue', '$' . number_format($totalRevenue, 2))
                ->description('Total revenue in the system')
                ->descriptionIcon('heroicon-o-credit-card')
                ->color('success'),

            Stat::make('Orders Today', $ordersToday)
                ->description('Orders placed today')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('info'),

            Stat::make('Pending Orders', $pendingOrders)
                ->description('Orders awaiting processing')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Completed Orders', $completedOrders)
                ->description('Orders successfully completed')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Total Concessions', $totalConcessions)
                ->description('Total available concessions')
                ->descriptionIcon('heroicon-o-tag')
                ->color('primary'),

            Stat::make('Total Menu Items', $totalMenuItems)
                ->description('Total menu items available')
                ->descriptionIcon('heroicon-o-presentation-chart-line')
                ->color('danger'),

            Stat::make('Total Staff Members', $totalStaffMembers)
                ->description('Total number of active staff members')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('secondary'),
        ];
    }
}
