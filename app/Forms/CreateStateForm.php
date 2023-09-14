<?php

namespace App\Forms;

use App\Models\Country;
use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\SpladeForm;

class CreateStateForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form
            ->action(route('admin.states.store'))
            ->class('p-4 bg-white rounded-md space-y-2');
    }

    public function fields(): array
    {
        return [
            Text::make('name')
                ->label('Name')
                ->rules(['required', 'max:60', 'min:3']),
            Select::make('country_id')
                ->label('Choose a country')
                ->options(Country::pluck('name', 'id')->toArray())
                ->rules('required'),
            Submit::make()
                ->label('Save'),
        ];
    }
}
