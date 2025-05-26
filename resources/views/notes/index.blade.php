<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="fw-bold mb-3">
                    Note Lists
                    <a href="{{ route('notes.create') }}" class="btn btn-primary">Create</a>
                </h1>

                {{-- Search Form --}}
                <form action="{{ route('notes.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search notes by title..." name="search"
                            value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                        @if (request('search'))
                            <a href="{{ route('notes.index') }}" class="btn btn-outline-danger">Clear</a>
                        @endif
                    </div>
                </form>
                ---

                <table class="table custom-bordered-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Tags</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($notes as $note)
                            <tr>
                                <th scope="row">{{ $note->id }}</th>
                                <td>{{ $note->title }}</td>
                                <td>
                                    @foreach ($note->tags as $tag)
                                        <span class="badge bg-secondary">{{ $tag->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $note->created_at }}</td>
                                <td>{{ $note->updated_at }}</td>
                                <td>
                                    <a class="btn btn-primary me-2 d-inline"
                                        href="{{ route('notes.note', ['id' => $note->id]) }}">See</a>
                                    <a class="btn btn-warning me-2 d-inline"
                                        href="{{ route('notes.edit', ['id' => $note->id]) }}">Update</a>
                                    <form action="{{ route('notes.delete', ['id' => $note->id]) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No notes found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $notes->links() }}
            </div>
        </div>
    </div>

    <style>
        .custom-bordered-table th,
        .custom-bordered-table td {
            border: 1px solid #dee2e6;
        }
    </style>
</x-app-layout>
