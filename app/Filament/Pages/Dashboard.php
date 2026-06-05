<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\QuickActions;
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
            // AccountWidget::class,
            // FilamentInfoWidget::class,
            QuickActions::class,
        ];
    }

    // public function getColumns(): int|string|array
    // {
    //     return 1; // semua widget full width
    // }
}