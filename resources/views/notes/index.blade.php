<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="fw-bold mb-3">Note Lists</h1>
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
                                    <a class="btn btn-primary"
                                        href="{{ route('notes.note', ['id' => $note->id]) }}">See</a>
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
