@extends('master')

@section('content')
    <div class="container">
        <h1>About Us</h1>
        <p>Welcome to our Fashion Store! We offer a diverse range of clothing options to suit your unique style. Whether
            you're looking for traditional attire, western outfits, we have
            something for everyone. Our goal is to provide high-quality fashion that makes you feel confident and stylish.
        </p>
        <h2 class="section-title">Clothing Categories</h2>
        <div class="clothing-category">
            <div class="category">
                <h3>Traditional</h3>
                <p>Explore our traditional clothing collection that showcases the rich cultural heritage and craftsmanship.
                    Perfect for special occasions and celebrations.</p>
            </div>
            <div class="category">
                <h3>Western</h3>
                <p>Discover our western clothing range that includes trendy and fashionable pieces for a modern look. Ideal
                    for casual outings and formal events.</p>
            </div>
            {{-- <div class="category">
                <h3>Men's Collection</h3>
                <p>Our men's collection features a variety of styles, from classic to contemporary, ensuring you find the
                    perfect outfit for any occasion.</p>
            </div>
            <div class="category">
                <h3>Women's Collection</h3>
                <p>Browse through our women's collection, offering elegant and chic options for every event. Find your
                    perfect dress, top, or accessory.</p>
            </div> --}}
        </div>
        <h2 class="section-title">Our Designers</h2>
        <div class="designers">
            <p>Our designers are the backbone of our fashion store, bringing their unique visions and creativity to life.
                Each piece in our collection is crafted with precision and care, ensuring you receive the highest quality
                garments. Our designers draw inspiration from various sources, including cultural heritage, modern trends,
                and timeless classics, to create pieces that are both fashionable and functional. We are proud to work with
                talented designers who are dedicated to pushing the boundaries of fashion and delivering exceptional styles
                to our customers.</p>
        </div>
    </div>

    <style>
        .navbar {
            background-color: #b5c99a;
            /* Light brown background color */
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            font-weight: bold;
        }

        .nav-item {
            margin-left: 30px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            /* background-color: #f4f4f4; */
        }

        .container {
            padding: 50px;
            /* background-color: #fff; */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 1200px;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title {
            margin-top: 40px;
            margin-bottom: 20px;
            font-size: 24px;
            color: #007BFF;
        }

        .clothing-category {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .category {
            flex: 1 1 45%;
            background-color: #f4f4f4;
            margin: 10px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .category h3 {
            margin-top: 0;
        }

        .designers {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .category {
                flex: 1 1 100%;
            }
        }

        /* Footer styling */
        footer {
            padding: 10px 0;
            /* Reduced padding */
            background-color: #1c2331;
            color: #fff;
            font-size: 14px;
            /* Reduced font size */
        }

        footer a {
            color: #fff;
            margin-right: 5px;
            /* Reduced margin */
        }

        footer .text-uppercase {
            margin-bottom: 5px;
            /* Reduced margin */
            font-size: 14px;
            /* Reduced font size */
        }

        footer .col-md-3,
        footer .col-md-2,
        footer .col-md-4 {
            margin-bottom: 5px;
            /* Reduced margin */
        }

        footer p {
            margin: 0;
            font-size: 12px;
            /* Reduced font size */
        }

        footer hr {
            margin: 5px 0;
            /* Reduced margin */
        }

        .footer-bottom {
            background-color: rgba(0, 0, 0, 0.2);
            padding: 5px 0;
            /* Reduced padding */
            font-size: 12px;
            /* Reduced font size */
        }

        .logout {
            background-color: black;
            color: white;
            font-weight: 200;
            border-radius: 5px;
        }

        .btn-outline-secondary {
            background-color: #b5c99a;
            color: black;
        }
    </style>
@endsection
