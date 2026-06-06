<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStat extends StatsOverviewWidget
{
    protected function getStats(): array
    {
           return [
            Stat::make('Total Asset', 1234)
                ->description('Seluruh asset terdaftar')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary')
                ->chart([7, 5, 10, 8, 12, 15, 20]),

            Stat::make('Total Pengguna', 45)
                ->description('Pengguna aktif')
                ->descriptionIcon('heroicon-m-users')
                ->color('warning')
                ->chart([2, 4, 5, 8, 10, 12, 15]),

            Stat::make('Asset Rusak', 8)
                ->description('Perlu diperhatikan')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger')
                ->chart([10, 8, 7, 6, 8, 7, 8]),

            Stat::make('Asset Tersedia', 1181)
                ->description('Siap digunakan')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart([1000, 1050, 1080, 1100, 1120, 1150, 1181]),
        ];
    }

    
}
