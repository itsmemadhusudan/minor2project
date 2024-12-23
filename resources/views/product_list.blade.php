@extends('master')
@section('content')
<div class="row g-4">

    @foreach ($items as $item)
        <div class="col-lg-3 col-md-6">
            <a href="{{ route('view_product', encrypt($item->id)) }}">
                <div class="card h-100 custom-card">
                    <img src="{{ asset('storage/' . $item->profile_picture) }}" class="card-img-top"
                        alt="Western Dress">

                    <div class="card-bottom-overlay">
                        <p class="card-text">{{ $item->designer_name }}<br />{{ $item->description }}</p>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection
