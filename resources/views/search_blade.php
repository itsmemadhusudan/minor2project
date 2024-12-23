@extends('master')
@section('content')
    <main class="container mt-4">
        @if($items->isEmpty())
            <p>No items found.</p>
        @else
            <div class="row g-4">
                @foreach($items as $item)
                    <div class="col-lg-3 col-md-6">
                        <div class="card h-100 custom-card">
                            <a href="{{ route('item.show', $item->id) }}">
                                <img src="{{ asset('storage/' . $item->image_path) }}" class="card-img-top" alt="{{ $item->name }}">
                            </a>
                            <div class="card-bottom-overlay">
                                <p class="card-text">{{ $item->name }}<br/>{{ $item->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

@endsection

