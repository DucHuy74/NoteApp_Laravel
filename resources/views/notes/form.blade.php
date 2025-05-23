<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Create Note</h2>

                <form method="POST" action="{{ route('notes.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title"
                            value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="text">Text</label>
                        <textarea class="form-control" name="text" id="text" rows="5" required>{{ old('text') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Create</button>
                    <a href="{{ route('notes.index') }}" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
