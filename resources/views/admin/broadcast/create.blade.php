<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Currency') }}
        </h2>
    </x-slot>

    <h1>Create Broadcast Message</h1>
<form action="{{ route('admin.broadcast.store') }}" method="POST">
    @csrf
    <label>Title:</label>
    <input type="text" name="title" required>

    <label>Content:</label>
    <textarea name="content" required></textarea>

    <label>Active:</label>
    <input type="checkbox" name="is_active" value="1" checked>

    <button type="submit">Save</button>
</form>

</x-admin-layout>
