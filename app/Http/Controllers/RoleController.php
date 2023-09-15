<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Tables\Roles;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index ()
    {
        return view('admin.roles.index', [
            'roles' => Roles::class,
        ]);
    }

    public function create()
    {
        $form = SpladeForm::make()
            ->action(route('admin.roles.store'))
            ->class('p-4 bg-white rounded-md space-y-2')
            ->fields([
                Input::make('name')->label('Name'),
                Submit::make()->label('Save'),
            ]);

        return view('admin.roles.create', [
            'form' => $form,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRoleRequest $request)
    {
        $role = Role::create($request->validated());
        Splade::toast('Role created')->autoDismiss(3);

        return to_route('admin.roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $form = SpladeForm::make()
            ->action(route('admin.roles.update', $role))
            ->method('PUT')
            ->class('p-4 bg-white rounded-md space-y-2')
            ->fields([
                Input::make('name')->label('Name'),
                Submit::make()->label('Update'),
            ])
            ->fill($role);

        return view('admin.roles.edit', [
            'form' => $form,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        Splade::toast('Role updated')->autoDismiss(3);
        return to_route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        Splade::toast('Role deleted')->autoDismiss(3);
        return back();
    }
}
