<?php

namespace App\Http\Controllers;

use App\Forms\CreateStateForm;
use App\Http\Requests\UpdateStateRequest;
use App\Models\State;
use App\Tables\States;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.states.index', [
            'states' => States::class,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.states.create', [
            'form' => CreateStateForm::class,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CreateStateForm $form)
    {
        State::create($form->validate($request));
        Splade::toast('State created')->autoDismiss(3);
        return to_route('admin.states.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        $form = SpladeForm::make()
            ->action(route('admin.states.update', $state))
            ->fields([
                Input::make('country_id')->label('Country ID'),
                Input::make('name')->label('State Name'),
                Submit::make()->label('Update'),
            ])
            ->class('p-4 bg-white rounded-md space-y-2')
            ->method('PUT')
            ->fill($state);
        return view('admin.states.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStateRequest $request, State $state)
    {
        $state->update($request->validated());
        Splade::toast('State updated')->autoDismiss(3);
        return to_route('admin.states.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        $state->delete();
        Splade::toast('State deleted')->autoDismiss(3);
        return back();
    }
}
