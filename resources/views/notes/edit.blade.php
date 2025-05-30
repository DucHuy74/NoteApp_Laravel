<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold mb-6">Edit Note</h2>

        <form method="POST" action="{{ route('notes.update', ['id' => $note->id]) }}" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('title', $note->title) }}" required>
            </div>

            {{-- Description --}}
            <div>
                <label for="text" class="block text-sm font-medium text-gray-700">Text</label>
                <textarea id="text" name="text" rows="5"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required>{{ old('text', $note->text) }}</textarea>
            </div>

            {{-- Tags --}}
            <div>
                <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                <input type="text" id="tags" name="tags"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('tags') border-red-500 @enderror"
                    value="{{ old('tags', $note->tags->pluck('tagName')->implode(', ')) }}">
                @error('tags')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Update
                </button>
                <a href="{{ route('notes.index') }}"
                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
