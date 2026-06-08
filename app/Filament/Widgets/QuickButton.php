<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class QuickButton extends Widget
{
    protected string $view = 'filament.widgets.quick-button';

    protected int|string|array $columnSpan = 'full';
    protected function getViewData(): array
    {
        return [
            'buttons' => [
                [
                    'label' => 'Scan QR Code',
                    'icon' => 'heroicon-m-qr-code',
                    'url' => \App\Filament\Pages\ScanQr::getUrl(),
                    'color' => 'primary',
                ],
                [
                    'label' => 'Tambah Asset',
                    'icon' => 'heroicon-m-plus',
                    'url' => route('filament.admin.resources.items.create'),
                    'color' => 'success',
                ],
                [
                    'label' => 'Daftar Asset',
                    'icon' => 'heroicon-m-list-bullet',
                    'url' => route('filament.admin.resources.items.index'),
                    'color' => 'warning',
                ],
            ],
        ];
    }
}
