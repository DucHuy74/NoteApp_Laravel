<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold mb-6">Create Note</h2>

        <form method="POST" action="{{ route('notes.store') }}" class="space-y-6">
            @csrf

            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                    value="{{ old('title') }}" required>
                @error('title')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="text" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="text" name="text" rows="5"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('text') border-red-500 @enderror"
                    required>{{ old('text') }}</textarea>
                @error('text')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tags --}}
            <div>
                <label for="tags" class="block text-sm font-medium text-gray-700">Tags (comma-separated)</label>
                <input type="text" id="tags" name="tags"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('tags') border-red-500 @enderror"
                    value="{{ old('tags') }}">
                @error('tags')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex gap-4">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                    Create
                </button>
                <a href="{{ route('notes.index') }}"
                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
