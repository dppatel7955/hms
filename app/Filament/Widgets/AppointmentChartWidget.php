<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class AppointmentChartWidget extends ChartWidget
{
    protected ?string $heading = 'Appointments (Last 7 Days)';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $appointmentCounts = [];
        $labels = [];

        for ($day = 6; $day >= 0; $day--) {
            $targetDate = Carbon::today()->subDays($day);
            $count = Appointment::whereDate('appointment_date', $targetDate)->count();
            
            $appointmentCounts[] = $count;
            $labels[] = $targetDate->format('D, M j');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Appointments Booked',
                    'data' => $appointmentCounts,
                    'backgroundColor' => '#0284c7', // Sky 600
                    'borderColor' => '#0369a1', // Sky 700
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
