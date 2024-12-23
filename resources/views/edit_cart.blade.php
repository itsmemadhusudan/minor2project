@extends('master')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Edit Cart Item</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('update_cart', encrypt($cart->id)) }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="size" class="form-label">Size</label>
                            <input type="text" class="form-control" id="size" name="size" value="{{ $cart->size }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $cart->quantity }}" required>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success" style="width: 150px;">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
