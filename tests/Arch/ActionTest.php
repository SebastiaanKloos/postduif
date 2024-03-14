<?php

use App\Contracts\Action;

arch('Actions should implement the action contract')
    ->expect('App\Actions')
    ->toImplement(Action::class)
    ->toBeClasses()
    ->toBeReadonly();
