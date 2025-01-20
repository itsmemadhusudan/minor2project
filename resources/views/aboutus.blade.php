@extends('master')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/aboutus.css') }}">
@endsection
@section('content')
    <div class="about-us">
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
@endsection