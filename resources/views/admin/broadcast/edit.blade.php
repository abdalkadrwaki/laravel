<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Currency') }}
        </h2>
    </x-slot>


    <h1>Edit Broadcast Message</h1>
    <form action="{{ route('admin.broadcast.update', $message->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Title:</label>
        <input type="text" name="title" value="{{ $message->title }}" required>

        <label>Content:</label>
        <textarea name="content" required>{{ $message->content }}</textarea>

        <label>Active:</label>
        <input type="checkbox" name="is_active" value="1" {{ $message->is_active ? 'checked' : '' }}>

        <button type="submit">Update</button>
    </form>


</x-admin-layout>
