@extends('master')

@section('content')
    <div class="container mt-4">
        <!-- Order Details -->
        <div class="card order-details-card mb-4 shadow">
           <div class="card-header">
                <h5>Order Details</h5>
           </div>
            <div class="card-body">
                <p><strong>Order ID:</strong> #{{ $orderID }}</p>
                <p><strong>Total Amount:</strong> NRP {{ $totalPrice }}</p>
                 <p><strong>Items:</strong> </p>
                  <ol>
                      @foreach($product as $item)
                        <li>
                            {{$item['product']['name']}} x {{$item['quantity']}} = NRP {{$item['product']['price'] * $item['quantity']}}
                        </li>
                       @endforeach
                   </ol>
                <!-- Add other order details as needed -->
            </div>
        </div>


        <div class="row mb-4">
            <!-- Cash on Delivery Option -->
            <div class="col-md-6">
                <div class="card payment-option-card shadow">
                  <div class="card-header cod-header">
                        <h5 class="mb-0"><i class="fas fa-money-bill-alt me-2"></i> Cash on Delivery</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Pay when your order arrives.</p>
                    <form action="{{ route('order.place') }}" method="POST">
                        @csrf
                        <input type="hidden" name="orderID" value="{{ $orderID }}">
                        <input type="hidden" name="totalPrice" value="{{ $totalPrice }}">
                        <button type="submit" class="btn btn-primary payment-btn">Place Order</button>
                    </form>
                    </div>
                </div>
            </div>

            <!-- Esewa Payment Option -->
            <div class="col-md-6">
                <div class="card payment-option-card shadow">
                   <div class="card-header esewa-header">
                         <h5 class="mb-0"><i class="fas fa-mobile-alt me-2"></i> Esewa</h5>
                   </div>
                    <div class="card-body">
                        <p class="card-text">Pay securely through Esewa.</p>
                        <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
                            <input type="hidden" id="amount" name="amount" value="{{ $totalPrice }}" required>
                            <input type="hidden" id="tax_amount" name="tax_amount" value ="0" required>
                            <input type="hidden" id="total_amount" name="total_amount" value="{{ $totalPrice }}" required>
                            <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="{{ $orderID }}" required>
                            <input type="hidden" id="orderID" name="orderID" value="{{ $orderID }}" required>
                            <input type="hidden" id="product_code" name="product_code" value ="EPAYTEST" required>
                            <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
                            <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
                            <input type="hidden" id="success_url" name="success_url" value="{{ route("cart.verifyEsewa") }}" required>
                            <input type="hidden" id="failure_url" name="failure_url" value="http://127.0.0.1:8000/" required>
                            <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
                            <input type="hidden" id="signature" name="signature" value="{{ $signature }}" required>
                            <input value="Pay with Esewa" class="btn btn-success payment-btn" type="submit">
                            </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
