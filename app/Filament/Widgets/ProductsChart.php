<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use DB;
use Filament\Widgets\ChartWidget;

class ProductsChart extends ChartWidget
{
    protected static ?string $heading = 'Sales';
    protected static string $color = 'info';

    protected function getData(): array
    {
        $dataset = [];
        $data = Order::selectRaw('MONTH(created_at) AS month, COUNT(*) AS orders')
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->get();
        foreach($data as $datum) {
            $dataset[Carbon::createFromFormat('n', $datum["month"])->format("M")] = $datum["orders"];
        }
        return [
            'datasets' => [
                [
                    'label' => 'Monthly Sales',
                    'data' => $dataset,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
