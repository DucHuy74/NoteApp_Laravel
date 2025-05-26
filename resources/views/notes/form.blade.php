<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Create Note</h2>

                <form method="POST" action="{{ route('notes.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            id="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="text" class="form-label">Description</label>
                        <textarea class="form-control @error('text') is-invalid @enderror" name="text" id="text" rows="5"
                            required>{{ old('text') }}</textarea>
                        @error('text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags</label>
                        <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags"
                            name="tags" value="{{ old('tags') }}">
                        <div class="form-text"></div>
                        @error('tags')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    ---

                    <button type="submit" class="btn btn-success">Create</button>
                    <a href="{{ route('notes.index') }}" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
