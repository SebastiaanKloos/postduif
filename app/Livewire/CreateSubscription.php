<?php

namespace App\Livewire;

use App\Actions\CreateSubscriptionAction;
use App\Models\Team;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class CreateSubscription extends Component implements HasForms, HasActions
{
    use InteractsWithForms, InteractsWithActions;

    public ?Team $team;

    public mixed $data;

    public ?string $message = null;

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                TextInput::make('name')
                    ->label('Je naam'),
                TextInput::make('email')
                    ->label('Je e-mailadres'),
            ]);
    }

    public function submitAction(): Action
    {
        return Action::make('submit')
            ->label('Aanmelden')
            ->extraAttributes(['class' => 'w-full'])
            ->size('xl')
            ->icon('heroicon-o-cursor-arrow-rays')
            ->action('submit');
    }

    public function submit()
    {
        $data = $this->form->getState();

        (new CreateSubscriptionAction(
            name: $data['name'],
            email: $data['email'],
            team: $this->team,
        ))->execute();

        $this->message = "Je bent aangemeld voor nieuws van {$this->team->name}.";
    }

    public function render()
    {
        return view('livewire.create-subscription');
    }
}
