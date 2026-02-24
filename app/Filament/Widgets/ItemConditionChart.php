<?php

namespace App\Filament\Widgets;

use App\Models\Item;
use Filament\Widgets\ChartWidget;

class ItemConditionChart extends ChartWidget
{
    protected ?string $heading = 'Kondisi Barang';

    protected int|string|array $columnSpan = [
         'default' => 12,  // mobile full
    'md' => 6,        // tablet setengah
    'xl' => 4,        // desktop 1/3
    ];

    protected function getData(): array
    {
        $data = Item::query()
            ->select('condition')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('condition')
            ->pluck('total', 'condition')
            ->toArray();

        $labels = collect(array_keys($data))->map(fn ($value) => match ($value) {
            'good' => 'Baik',
            'broken' => 'Rusak',
            default => ucfirst($value),
        }
        )->toArray();

        return [
            'datasets' => [
                [
                    'data' => array_values($data),
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
