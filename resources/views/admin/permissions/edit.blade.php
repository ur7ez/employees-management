<x-admin-layout>
    <h1 class="text-2xl font-semibold p-4">Edit Permission</h1>
    <x-splade-form
        method="PUT"
        :default="$permission"
        :action="route('admin.permissions.update', $permission)"
        class="p-4 bg-white rounded-md space-y-2"
    >
        <x-splade-input name="name" label="Name"/>
        <x-splade-select name="roles[]" :options="$roles" multiple relation choices label="Roles"/>
        <x-splade-submit label="Update"/>
    </x-splade-form>
</x-admin-layout>
