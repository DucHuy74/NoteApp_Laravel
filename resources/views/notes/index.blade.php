<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="fw-bold mb-3">
                    Note Lists
                    <a href="{{ route('notes.create') }}" class="btn btn-primary">Create</a>
                </h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notes as $note)
                            <tr>
                                <th scope="row">{{ $note->id }}</th>
                                <td>{{ $note->title }}</td>
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
                        @endforeach
                    </tbody>
                </table>
                {{ $notes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
