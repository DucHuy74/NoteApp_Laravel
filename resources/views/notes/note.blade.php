<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-bg-light">
                    <div class="card-header">{{ $note->title }}</div>
                    <div class="card-body">
                        <p class="card-text">{{ $note->text }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
