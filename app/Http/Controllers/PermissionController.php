<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Tables\Permissions;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index ()
    {
        return view('admin.permissions.index', [
            'permissions' => Permissions::class,
        ]);
    }

    public function create()
    {
        $form = SpladeForm::make()
            ->action(route('admin.permissions.store'))
            ->class('p-4 bg-white rounded-md space-y-2')
            ->fields([
                Input::make('name')->label('Name'),
                Submit::make()->label('Save'),
            ]);

        return view('admin.permissions.create', [
            'form' => $form,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePermissionRequest $request)
    {
        $permission = Permission::create($request->validated());
        Splade::toast('Permission created')->autoDismiss(3);

        return to_route('admin.permissions.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        $form = SpladeForm::make()
            ->action(route('admin.permissions.update', $permission))
            ->method('PUT')
            ->class('p-4 bg-white rounded-md space-y-2')
            ->fields([
                Input::make('name')->label('Name'),
                Submit::make()->label('Update'),
            ])
            ->fill($permission);

        return view('admin.permissions.edit', [
            'form' => $form,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->validated());
        Splade::toast('Permission updated')->autoDismiss(3);
        return to_route('admin.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        Splade::toast('Permission deleted')->autoDismiss(3);
        return back();
    }
}
