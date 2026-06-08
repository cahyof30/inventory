<?php

namespace App\Filament\Widgets;

use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStat extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalAssets = Item::all()->count();
        $totalUsers = User::all()->count(); // Ganti dengan model pengguna yang sesuai
        $damagedAssets = Item::where('condition', 'broken')->get()->count();
        $availableAssets = Item::where('condition', 'good')->get()->count();

        // 2. Generate Data Chart Dinamis (Tren 7 Bulan Terakhir)
        $chartAsset = [];
        for ($i = 6; $i >= 0; $i--) {
            // Mengambil batas akhir dari masing-masing bulan (6 bulan lalu sampai bulan ini)
            $bulan = Carbon::now()->subMonths($i)->endOfMonth();
            
            // Menghitung akumulasi asset yang terdaftar sampai bulan tersebut
            $chartAsset[] = Item::where('created_at', '<=', $bulan)->count();
        }
        $chartUser = [];
        for ($i = 6; $i >= 0; $i--) {
            // Mengambil batas akhir dari masing-masing bulan (6 bulan lalu sampai bulan ini)
            $bulan = Carbon::now()->subMonths($i)->endOfMonth();
            
            // Menghitung akumulasi pengguna yang terdaftar sampai bulan tersebut
            $chartUser[] = User::where('created_at', '<=', $bulan)->count();
        }
        $chartDamagedAssets = [];
        for ($i = 6; $i >= 0; $i--) {
            // Mengambil batas akhir dari masing-masing bulan (6 bulan lalu sampai bulan ini)
            $bulan = Carbon::now()->subMonths($i)->endOfMonth();
            
            // Menghitung akumulasi asset rusak sampai bulan tersebut
            $chartDamagedAssets[] = Item::where('created_at', '<=', $bulan)->where('condition', 'broken')->count();
        }
        $chartAvailableAssets = [];
        for ($i = 6; $i >= 0; $i--) {
            // Mengambil batas akhir dari masing-masing bulan (6 bulan lalu sampai bulan ini)
            $bulan = Carbon::now()->subMonths($i)->endOfMonth();
            
            // Menghitung akumulasi asset tersedia sampai bulan tersebut
            $chartAvailableAssets[] = Item::where('created_at', '<=', $bulan)->where('condition', 'good')->count();
        }

           return [
            Stat::make('Total Asset', $totalAssets)
                ->description('Seluruh asset terdaftar')
                ->descriptionIcon('heroicon-m-cube')
                ->color('info')
                ->chart($chartAsset),

            Stat::make('Total Pengguna', $totalUsers)
                ->description('Pengguna aktif')
                ->descriptionIcon('heroicon-m-users')
                ->color('warning')
                // ->chart([2, 4, 5, 8, 10, 12, 15]),
                ->chart($chartUser),

            Stat::make('Asset Rusak', $damagedAssets)
                ->description('Perlu diperhatikan')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger')
                // ->chart([10, 8, 7, 6, 8, 7, 8]),
                ->chart($chartDamagedAssets),


            Stat::make('Asset Tersedia', $availableAssets)
                ->description('Siap digunakan')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                // ->chart([1000, 1050, 1080, 1100, 1120, 1150, 1181]),
                ->chart($chartAvailableAssets),
        ];
    }

    
}
