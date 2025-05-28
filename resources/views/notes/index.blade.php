<x-app-layout>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold">📋 Note Lists</h1>
                    <a href="{{ route('notes.create') }}" class="btn btn-primary shadow-sm">+ Create</a>
                </div>

                {{-- Search Form --}}
                <form action="{{ route('notes.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control shadow-sm" placeholder="🔍 Search notes by title..."
                            name="search" value="{{ request('search') }}">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                        @if (request('search'))
                            <a href="{{ route('notes.index') }}" class="btn btn-outline-danger">Clear</a>
                        @endif
                    </div>
                </form>

                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table table-bordered align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Tags</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($notes as $note)
                                <tr>
                                    <th>{{ $note->id }}</th>
                                    <td class="fw-semibold">{{ $note->title }}</td>
                                    <td>
                                        @foreach ($note->tags as $tag)
                                            <span class="badge bg-secondary">{{ $tag->tagName }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $note->created_at }}</td>
                                    <td>{{ $note->updated_at }}</td>
                                    <td class="d-flex gap-1 flex-wrap">
                                        <a class="btn btn-sm btn-info text-white"
                                            href="{{ route('notes.note', ['id' => $note->id]) }}">
                                            See
                                        </a>
                                        <a class="btn btn-sm btn-warning"
                                            href="{{ route('notes.edit', ['id' => $note->id]) }}">
                                            Update
                                        </a>
                                        <form action="{{ route('notes.delete', ['id' => $note->id]) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No notes found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $notes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
