<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\DamagedAssetWidget;
use App\Filament\Widgets\DashboardStat;
use App\Filament\Widgets\QuickActions;
use App\Filament\Widgets\QuickButton;
use App\Filament\Widgets\RecentAssetWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;

class Dashboard extends BaseDashboard
{
    public function getHeaderWidgets(): array
    {
        return [];  // kosongkan, atau isi widget yang mau di header
    }

    public function getWidgets(): array
    {
        return [
             QuickButton::class,
             DashboardStat::class,
             RecentAssetWidget::class,
             DamagedAssetWidget::class,
        ];
    }

    // public function getColumns(): int|string|array
    // {
    //     return 1; // semua widget full width
    // }
}