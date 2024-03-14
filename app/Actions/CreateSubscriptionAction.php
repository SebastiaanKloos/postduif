<?php

namespace App\Actions;

use App\Contracts\Action;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

readonly class CreateSubscriptionAction implements Action
{
    public function __construct(
        public string $name,
        public string $email,
        public Team $team
    ) {}

    public function execute(): void
    {
        $user = User::query()
            ->firstOrCreate([
                'email' => $this->email,
            ], [
                'name' => $this->name,
                'password' => Hash::make(Uuid::uuid4()),
            ]);

        $user->subscribedTo()->attach($this->team->id);
    }
}
