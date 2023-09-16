<x-admin-layout>
    <h1 class="text-2xl font-semibold p-4">New User</h1>
    <x-splade-form
        :action="route('admin.users.store')"
        class="p-4 bg-white rounded-md space-y-2"
    >
        <x-splade-input name="username" label="User name"/>
        <x-splade-input name="first_name" label="First name"/>
        <x-splade-input name="last_name" label="Last name"/>
        <x-splade-input name="email" label="Email address"/>
        <x-splade-input type="password" name="password" label="Password"/>
        <x-splade-input type="password" name="password_confirmation" label="Password confirmation"/>
        <x-splade-select name="roles[]" :options="$roles" multiple relation choices label="Roles"/>
        <x-splade-select name="permissions[]" :options="$permissions" multiple relation choices label="Permissions"/>
        <x-splade-submit/>
    </x-splade-form>
</x-admin-layout>
