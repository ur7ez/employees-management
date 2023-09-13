<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use App\Tables\Countries;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.countries.index', [
            'countries' => Countries::class,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCountryRequest $request)
    {
        Country::create($request->validated());
        Splade::toast('Country created')->autoDismiss(3);
        return to_route('admin.countries.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        $form = SpladeForm::make()
            ->action(route('admin.countries.update', $country))
            ->fields([
                Input::make('country_code')->label('Country Code'),
                Input::make('name')->label('Country Name'),
                Submit::make()->label('Update'),
            ])
            ->class('p-4 bg-white rounded-md space-y-2')
            ->method('PUT')
            ->fill($country);
        return view('admin.countries.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->update($request->validated());
        Splade::toast('Country updated')->autoDismiss(3);
        return to_route('admin.countries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();
        Splade::toast('Country deleted')->autoDismiss(3);
        return back();
    }
}
