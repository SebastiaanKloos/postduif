<?php

use App\Livewire\CreateSubscription;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('registreren/{team:code}', CreateSubscription::class)->name('create-subscription');
