<?php

namespace App\Filament\Widgets;

use App\Models\Billing;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class RevenueChartWidget extends ChartWidget
{
    protected ?string $heading = 'Monthly Revenue (Current Year)';
    
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $revenueData = [];
        $labels = [];
        
        $currentYear = Carbon::now()->year;

        for ($month = 1; $month <= 12; $month++) {
            $sum = Billing::where('status', 'paid')
                ->whereYear('billing_date', $currentYear)
                ->whereMonth('billing_date', $month)
                ->sum('grand_total');
                
            $revenueData[] = floatval($sum);
            $labels[] = Carbon::create(null, $month, 1)->format('M');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Revenue ($)',
                    'data' => $revenueData,
                    'borderColor' => '#0f766e', // Teal 700
                    'backgroundColor' => 'rgba(15, 118, 110, 0.1)',
                    'fill' => 'start',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
