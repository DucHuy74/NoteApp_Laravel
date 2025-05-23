<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Edit Note</h2>
                <form method="POST" action="{{ route('notes.update', ['id' => $note->id]) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title"
                            value="{{ old('title', $note->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="text">Text</label>
                        <textarea class="form-control" name="text" id="text" rows="5" required>{{ old('text', $note->text) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('notes.index') }}" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
