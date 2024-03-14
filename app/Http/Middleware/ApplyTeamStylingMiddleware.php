<?php

namespace App\Http\Middleware;

use App\Models\Team;
use Closure;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Http\Request;

class ApplyTeamStylingMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $team = $request->route()->parameter('team');
        $tenant = $request->route()->parameter('tenant');

        if (! $team & $tenant) {
            $team = Team::find($tenant);
        }

        if (filled($team) && $team instanceof Team) {
            FilamentColor::register([
                'primary' => Color::hex($team->primary_color),
                'secondary' => Color::hex($team->secondary_color),
            ]);
        }

        return $next($request);
    }
}
