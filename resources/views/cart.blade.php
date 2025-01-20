@extends('master')

@section('content')
<div class="row my-4">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="wishlist-table col-md-8">
        <div class="responsive-table">
            <table class="table border text-center">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Size</th>
                        <th>Price(Rs.)</th>
                        <th>Quantity</th>
                        <th>Sub Total(Rs.)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_amount = 0;
                        $cart_ids = [];
                    @endphp
                    @foreach ($cartItems as $item)
                    @isset($item->product)
                        <tr>
                            <td>{{ $item->product->name }} </td>
                            <td>{{ $item->size }} </td>
                            <td>{{ $item->product->price }} </td>
                            <td>{{ $item->quantity }} </td>
                            <td>{{ $item->product->price * $item->quantity }} </td>
                            <td>
                                <a href="{{ route('edit_cart', encrypt($item->id)) }}" style="text-decoration: none;">
                                    <button style="padding: 5px 10px; color: white; background-color: #007bff; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Edit</button>
                                </a>
                                <a href="#" onclick="confirmDelete('{{ route('delete_cart', encrypt($item->id)) }}'); return false;" style="text-decoration: none;">
                                    <button style="padding: 5px 10px; color: white; background-color: #dc3545; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Delete</button>
                                </a>
                            </td>
                            
                        </tr>
                        @php
                            $total_amount += $item->product->price * $item->quantity;
                            array_push($cart_ids, $item->id);
                        @endphp
                        @endisset
                    @endforeach
                </tbody>
            </table>
        </div>

        <script></script>
        <div class="row">
            <div class="col-md-6">
                <div class="share-wishlist shoping-con">
                    <a href="{{ url('/') }}" class="link"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="cart-total-table">
            <div class="responsive-table">
                <table class="table border">
                    <thead>
                        <tr>
                            <th colspan="2">Cart Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total (Rs.)</td>
                            <td>
                                <div class="price-box">
                                    <span class="price"> {{ $total_amount }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Discount Amount (10%)</td>
                            <td>
                                <div class="price-box">
                                    <span class="price"> {{ $total_amount * 0.1 }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="payable"><b>Amount Payable (Rs.)</b></td>
                            <td>
                                <div class="price-box">
                                    <span class="price"> <span class="price">
                                        <b>{{ $total_amount - $total_amount * 0.1 }}</b></span></span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="share-wishlist">
                @if(count($cartItems) > 0)
                <a href="{{ route('cart.checkout') }}" class="btn btn-success small">Proceed to Payment</a>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(url) {
        if (confirm('Are you sure you want to delete this item?')) {
            window.location.href = url;
        }
    }
</script>
@endsection
