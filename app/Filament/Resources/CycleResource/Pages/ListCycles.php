<?php

namespace App\Filament\Resources\CycleResource\Pages;

use App\Filament\Resources\CycleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CycleResource\Widgets\CiclesCharPie;
use App\Filament\Resources\CycleResource\Widgets\CyclesChartStat;

class ListCycles extends ListRecords
{
    protected static string $resource = CycleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
//            CyclesChartStat::class,
            CiclesCharPie::class,

        ];
    }
}
