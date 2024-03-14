<?php

namespace App\Filament\App\Pages;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Facades\Filament;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class EditTeam extends Page implements HasForms, HasActions
{
    use InteractsWithForms, InteractsWithActions;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.app.pages.edit-team';

    protected static ?string $title = 'Instellingen';

    public mixed $data;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function mount()
    {
        $this->form->fill(Filament::getTenant()->getAttributes());
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->inlineLabel()
            ->model(Filament::getTenant())
            ->schema([
                Section::make()
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('logo')
                            ->label('Logo')
                            ->collection('logo')
                            ->image()
                            ->imageEditor(),
                        TextInput::make('name')
                            ->label('Naam')
                            ->disabled()
                            ->helperText('Neem contact op met de systeembeheerders als je deze wilt aanpassen.'),
                        ColorPicker::make('primary_color')
                            ->label('Primaire kleur'),
                        ColorPicker::make('secondary_color')
                            ->label('Secundaire kleur'),
                        Textarea::make('description')
                            ->label('Omschrijving')
                            ->rows(8),
                    ]),
            ]);
    }

    public function submitAction(): Action
    {
        return Action::make('submit')
            ->label('Opslaan')
            ->action('submit');
    }

    public function submit()
    {
        $data = $this->form->getState();

        Filament::getTenant()
            ->update($data);

        Notification::make()
            ->title('Instellingen')
            ->body('De wijzigingen zijn opgeslagen')
            ->success()
            ->send();
    }
}
