@extends('master')
@section('content')

<div class="empty"></div>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="sidebar">
                <h4>Filters By:</h4>
                <hr>
                <form>
                    <div class="mb-3">
                        <label for="priceDropdown" class="form-label">Price</label>
                        <select class="form-control" id="priceDropdown">
                            <option value="">Select Price Range</option>
                            <option value="5000">Up to 5000</option>
                            <option value="6000">Up to 6000</option>
                            <option value="7000">Up to 7000</option>
                            <option value="8000">Up to 8000</option>
                        </select>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label for="western" class="form-label">
                            <a href="{{ route('western') }}" class="text-decoration-none filter-category" data-category="western">Western</a>
                        </label>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label for="cultural" class="form-label">
                            <a href="{{ route('cultural') }}" class="text-decoration-none filter-category" data-category="cultural">Cultural</a>
                        </label>
                    </div>
                    <hr>
                </form>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php $itemCount = 0; ?>
                @foreach ($uploads as $item)
                <?php $itemCount++; ?>
                <div class="col-lg-3 col-md-6 product-card" data-price="{{ $item->price }}" data-category="{{ $item->category }}" data-designer="{{ $item->designer_name }}">
                    <div class="card h-100 custom-card" data-itemCount=" <?php echo $itemCount; ?>">
                        <a href="{{ route('view_product', encrypt($item->id)) }}">
                            <img src="{{ asset('storage/' . $item->profile_picture) }}" class="card-img-top" alt="...">
                        </a>
                        <div class="card-bottom-overlay">
                            <p class="card-text">{{ $item->designer_name }}<br/>{{ $item->description }}<br/>{{ $item->category }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="emptytwo"></div>
<div class="container-fluid p-0"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const priceDropdown = document.getElementById('priceDropdown');
        const categoryLinks = document.querySelectorAll('.filter-category');
        const productCards = document.querySelectorAll('.product-card');

        let selectedCategory = '';

        priceDropdown.addEventListener('change', filterProducts);
        categoryLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                selectedCategory = event.target.getAttribute('data-category');
                filterProducts();
            });
        });

        function filterProducts() {
            const price = parseInt(priceDropdown.value, 10);

            productCards.forEach(card => {
                const cardPrice = parseInt(card.getAttribute('data-price'), 10);
                const cardCategory = card.getAttribute('data-category');

                // Check if the card matches the selected category
                const matchesCategory = !selectedCategory || cardCategory === selectedCategory;

                // Check if the card matches the price filter
                const matchesPrice = isNaN(price) || cardPrice <= price;

                // Show or hide the card based on both filters
                if (matchesCategory && matchesPrice) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    });
</script>
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const priceDropdown = document.getElementById('priceDropdown');
        const categoryLinks = document.querySelectorAll('.filter-category');
        const productCards = document.querySelectorAll('.product-card');

        let selectedCategory = '';

        // Event listener for price dropdown
        priceDropdown.addEventListener('change', filterProducts);

        // Event listeners for category links
        categoryLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                selectedCategory = event.target.getAttribute('data-category');
                console.log(`Selected category: ${selectedCategory}`);
                filterProducts();
            });
        });

        // Function to filter products based on both price and category
        function filterProducts() {
            const price = parseInt(priceDropdown.value, 10);

            productCards.forEach(card => {
                const cardPrice = parseInt(card.getAttribute('data-price'), 10);
                const cardCategory = card.getAttribute('data-category');
                const cardCount = card.getAttribute('data-itemcount');
                console.log(`Card category: ${cardCategory}`);

                // Check if the card matches the selected category
                const matchesCategory = !selectedCategory || cardCategory === selectedCategory;

                // Check if the card matches the price filter
                const matchesPrice = isNaN(price) || cardPrice <= price;

                // Show or hide the card based on both filters
                if (matchesCategory && matchesPrice) {
                    console.log(`Filtered card: ${}`)
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    });
</script> --}}
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const priceDropdown = document.getElementById('priceDropdown');
        const categoryLinks = document.querySelectorAll('.filter-category');
        const productCards = document.querySelectorAll('.product-card');

        let selectedCategory = '';

        // Event listener for price dropdown
        priceDropdown.addEventListener('change', filterProducts);

        // Event listeners for category links
        categoryLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                selectedCategory = event.target.getAttribute('data-category');
                filterProducts();
            });
        });

        // Function to filter products based on both price and category
        function filterProducts() {
            const price = parseInt(priceDropdown.value, 10);

            productCards.forEach(card => {
                const cardPrice = parseInt(card.getAttribute('data-price'), 10);
                const cardCategory = card.getAttribute('data-category');

                // Check if the card matches the selected category
                const matchesCategory = !selectedCategory || cardCategory === selectedCategory;

                // Check if the card matches the price filter
                const matchesPrice = isNaN(price) || cardPrice <= price;

                // Show or hide the card based on both filters
                if (matchesCategory && matchesPrice) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    });
</script> --}}




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
    .container.my-5 {
        width: auto;
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
    .custom-card {
        position: relative;
        overflow: hidden;
    }
    .custom-card img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.3s ease-in-out;
    }
    .custom-card:hover img {
        transform: scale(1.1);
    }
    .card-bottom-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        text-align: center;
        padding: 20px;
    }
    .sidebar {
        background-color: #f0f0f0;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .sidebar h4 {
        margin-bottom: 15px;
        font-weight: bold;
    }
    .sidebar hr {
        margin-top: 5px;
        margin-bottom: 10px;
        border-color: #ddd;
    }
    .space {
        height: 20px;
        width: 100%;
    }
    .empty {
        height: 20px;
        width: 100%;
    }
</style>

@endsection
