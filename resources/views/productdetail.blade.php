@extends('master')
@section('content')
 <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
        <div class="row bg-light shadow rounded p-4" style="max-width: 800px;">
            <div class="col-md-6 image-container">
                <img src="{{ asset('storage/' . $product->profile_picture) }}" alt="Image">
            </div>
            <div class="col-md-6 form-container">
                <h2>Details</h2>
                <form action="{{ route('store_cart') }}" method="post">
                    @csrf
                    <label for="price">Price: {{ $product->price }}</label> <br/> <br/>
                    <label for="description">Description: {{ $product->description }}</label> <br/> <br/>
                    <label for="size">Size:</label>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <span id="selected-size"></span> <br/> <br/>
                    <div>
                        <input class="form-check-input me-2" type="radio" name="size" value="S" id="sizeS" onchange="updateSize()" />
                        <label class="form-check-label" for="sizeS">S</label>
                        <input class="form-check-input me-2" type="radio" name="size" value="M" id="sizeM" onchange="updateSize()" />
                        <label class="form-check-label" for="sizeM">M</label>
                        <input class="form-check-input me-2" type="radio" name="size" value="L" id="sizeL" onchange="updateSize()" />
                        <label class="form-check-label" for="sizeL">L</label>
                        <input class="form-check-input me-2" type="radio" name="size" value="XL" id="sizeXL" onchange="updateSize()" />
                        <label class="form-check-label" for="sizeXL">XL</label>
                        <input class="form-check-input me-2" type="radio" name="size" value="XXL" id="sizeXXL" onchange="updateSize()" />
                        <label class="form-check-label" for="sizeXXL">XXL</label>
                        <input class="form-check-input me-2" type="radio" name="size" value="XXXL" id="sizeXXXL" onchange="updateSize()" />
                        <label class="form-check-label" for="sizeXXXL">XXXL</label>
                    </div>
                    <br/>
                    <label for="qty">Quantity:</label>
                    <input type="number" name="quantity" id="qty">



                    <div class="d-flex justify-content-between mt-4">
                        {{-- <button type="button" class="btn btn-primary btn-lg" style="background-color: black; border-radius: 5px;">Buy Now</button> --}}
                        <button type="submit" class="btn btn-primary btn-lg" style="background-color: black; border-radius: 5px;">Add to Cart</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
        <script>
        function updateSize() {
            const selectedSize = document.querySelector('.form-check-input:checked').value;
            document.getElementById('selected-size').innerText = selectedSize;
        }
        </script>
         <style>
            .navbar {
                background-color: #b5c99a;
                font-family: 'Montserrat', sans-serif;
                font-size: 16px;
                font-weight: bold;
            }
            .nav-item {
                margin-left: 30px;
            }
            .btn-outline-secondary {
                background-color: #b5c99a;
                color: black;
            }
            .navbar-brand {
                font-family: 'Montserrat', sans-serif;
                font-weight: bold;
            }
            .gradient-custom-2 {
                background: #fccb90;
                background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
                background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
            }
            @media (min-width: 768px) {
                .gradient-form {
                    height: 100vh !important;
                }
            }
            @media (min-width: 769px) {
                .gradient-custom-2 {
                    border-top-right-radius: .3rem;
                    border-bottom-right-radius: .3rem;
                }
            }
            .logout {
                background-color: #1c2331;
                color: white;
                font-weight: 200;
                border-radius: 5px;
            }
            .image-container img {
                width: 100%;
                height: auto;
                object-fit: cover;
            }
            .form-container {
                padding: 20px;
            }
        </style>
@endsection
