<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;

class DemandedProductsChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $products = Product::withCount("orders")->orderBy("orders_count", "DESC")->limit(10)->get();
        $colors = [
            "#FFB3BA",
            "#FFDFBA",
            "#FFABAB",
            "#FFC3A0",
            "#D5AAFF",
            "#A0E7E5",
            "#B9FBC0",
            "#C1E1C1",
            "#F9D5E5",
            "#FFE156"
        ];
        return [
            'datasets' => [
                [
                    'label' => 'Monthly Sales',
                    'data' => $products->pluck("orders_count")->toArray(),
                    'backgroundColor' => $colors
                ],
            ],
            'labels' => $products->pluck("title")->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
