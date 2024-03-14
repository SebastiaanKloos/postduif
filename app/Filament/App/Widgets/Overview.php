<?php

namespace App\Filament\App\Widgets;

use App\Filament\App\Resources\EventResource;
use App\Filament\App\Resources\PostResource;
use App\Filament\App\Resources\SubscriptionResource;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Overview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Inschrijvingen', Filament::getTenant()->subscribedUsers()->count())
                ->icon('heroicon-o-users')
                ->url(SubscriptionResource::getUrl()),
            Stat::make('Posts', Filament::getTenant()->posts()->count())
                ->icon('heroicon-o-newspaper')
                ->url(PostResource::getUrl()),
            Stat::make('Agenda', Filament::getTenant()->events()->count())
                ->icon('heroicon-o-calendar-days')
                ->url(EventResource::getUrl()),
        ];
    }
}
