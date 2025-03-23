<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Currency') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">

                <a href="{{ route('admin.broadcast.create') }}" class="btn btn-primary mb-3">Create New Message</a>
                <div class="table-responsive shadow-lg rounded-lg bg-white p-6 m-4">
                    <table class="table table-bordered table-hover table-striped ">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Active</th>
                                <th>Actions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $message)
                                <tr>
                                    <td>{{ $message->title }}</td>
                                    <td>{{ $message->content }}</td>
                                    <td>{{ $message->is_active ? 'Yes' : 'No' }}</td>
<td> <a href="{{ route('admin.broadcast.edit', $message->id) }}">Edit</a></td>
                                    <td>

                                        <form action="{{ route('admin.broadcast.destroy', $message->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</x-admin-layout>
