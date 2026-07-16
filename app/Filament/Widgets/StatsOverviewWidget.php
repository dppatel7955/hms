<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use App\Models\Admission;
use App\Models\Appointment;
use App\Models\Billing;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected function getStats(): array
    {
        $patientCount = Patient::count();
        $activeInpatients = Admission::where('status', 'admitted')->count();
        $todayAppointments = Appointment::whereDate('appointment_date', Carbon::today())->count();
        
        $monthlyRevenue = Billing::where('status', 'paid')
            ->whereMonth('billing_date', Carbon::today()->month)
            ->whereYear('billing_date', Carbon::today()->year)
            ->sum('grand_total');

        return [
            Stat::make('Total Registered Patients', $patientCount)
                ->description('All registered patient profiles')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
            Stat::make('Active Inpatients', $activeInpatients)
                ->description('Patients currently admitted in wards')
                ->descriptionIcon('heroicon-m-home')
                ->color('warning'),
            Stat::make('Today\'s Appointments', $todayAppointments)
                ->description('Appointments scheduled for today')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),
            Stat::make('This Month\'s Earnings', '$' . number_format($monthlyRevenue, 2))
                ->description('Received payments this month')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
        ];
    }
}
