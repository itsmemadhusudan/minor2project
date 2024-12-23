@extends('master')

@section('content')
<div class="row">
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
                        <tr>
                            <td>{{ $item->product->designer_name }} </td>
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
                    @endforeach
                </tbody>
            </table>
        </div>

        <script></script>
        <div class="row">
            <div class="col-md-6">
                <div class="share-wishlist shoping-con">
                    <a href="{{ url('/') }}" class="btn small"><i class="fa fa-angle-left"></i> Continue Shopping</a>
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
                <form action="https://uat.esewa.com.np/epay/main" method="POST">
                    @csrf
                    <input type="hidden" name="tAmt" value="{{ $total_amount - $total_amount * 0.1 }}" required>
                    <input type="hidden" name="amt" value="{{ $total_amount - $total_amount * 0.1 }}" required>
                    <input type="hidden" name="txAmt" value="0" required>
                    <input type="hidden" name="psc" value="0" required>
                    <input type="hidden" name="pdc" value="0" required>
                    <input type="hidden" name="scd" value="EPAYTEST" required>
                    <input type="hidden" name="pid" value="{{ \Str::uuid() }}" required>
                    <input type="hidden" name="su" value="{{ url('payment-verify?oid=' . json_encode($cart_ids)) }}" required>
                    <input type="hidden" name="fu" value="{{ url('payment-fail') }}" required>
                    <button type="submit" class="btn btn-success small">Checkout via E-sewa</button>
                </form>
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
