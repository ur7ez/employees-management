<x-admin-layout>
    <div class="flex justify-between">
        <h1 class="text-2xl font-semibold p-4">Users Index</h1>
        <div class="p-4">
            <Link href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded text-white">New User</Link>
        </div>
    </div>
    <x-splade-table :for="$users">
        @cell('action', $user)
        <div class="space-x-2">
            <Link
                href="{{ route('admin.users.edit', $user) }}"
                class="px-4 py-1 text-green-400 hover:bg-green-700 font-semibold rounded-md"
            >Edit</Link>
            <Link
                href="{{ route('admin.users.destroy', $user) }}"
                method="DELETE"
                confirm-danger="Delete the user"
                confirm-text="Are you sure you want to delete user `{{ $user->username }}`?"
                confirm-button="Yes"
                cancel-button="No"
                class="px-4 py-1 text-red-400 hover:bg-red-700 font-semibold rounded-md"
            >Delete</Link>
        </div>
        @endcell
    </x-splade-table>
</x-admin-layout>
