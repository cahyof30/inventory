<?php

namespace App\Providers\Filament;

use App\Filament\Auth\Login as SGMLogin;
use App\Filament\Pages\Dashboard;
use App\Filament\Pages\PeminjamanPage;
use App\Filament\Widgets\ItemConditionChart;
use App\Filament\Widgets\QuickActions;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Hammadzafar05\MobileBottomNav\MobileBottomNav;
use Hammadzafar05\MobileBottomNav\MobileBottomNavItem;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->favicon(asset('icon-sgm.ico'))
            // --- TAMBAHKAN LINE DI BAWAH INI ---
            ->brandLogo(asset('assets/logo-dashboard.png')) 
            // Optional: Mengatur tinggi logo agar pas di navbar
            ->brandLogoHeight('3.5rem') 
            // ----------------------------------
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            // ... konfigurasi lainnya
            ->login(SGMLogin::class)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
                PeminjamanPage::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
                QuickActions::class,
                // ItemConditionChart::class,
            ])
            // ->viteTheme('resources/css/app.css')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                MobileBottomNav::make()
                    ->moreButton(true)
                    ->items([
                        MobileBottomNavItem::make('Dashboard')
                            ->icon('heroicon-o-home')
                            ->activeIcon('heroicon-s-home')
                            ->url('/admin')
                            ->isActive(fn () => request()->is('admin')),
                        MobileBottomNavItem::make('Peminjaman')
                            ->icon('heroicon-o-arrow-path')
                            ->activeIcon('heroicon-s-arrow-path')
                            ->url('/admin/peminjaman')                  // ← URL baru
                            ->isActive(fn () => request()->is('admin/peminjaman*')),
                        MobileBottomNavItem::make('Scan QR')
                            ->icon('heroicon-o-qr-code')
                            ->url('/admin/scan-qr'),
                        MobileBottomNavItem::make('Aset')
                            ->icon('heroicon-o-archive-box')
                            ->url('/admin/items'),
                        // MobileBottomNavItem::make('More')
                        //     ->icon('heroicon-o-archive-box')
                        //     ->url('/admin/items'),
                        // ->badge(5, 'danger'),
                    ]),
            ]);
    }
}
