@extends('master')
@section('content')
  <div class="container center-content my-5">
        <div class="row bg-light shadow rounded p-4" style="max-width: 1150px; align-items: center;">
            <div class="col-md-6 image-container" style="width: 50%; height: 650px;">
                <img src="{{ asset('assets/image/j.jpg') }}" alt="Image" style="width: 98%; height: 100%;">
            </div>
            <div class="col-md-6 form-container" style="width: 450px; height: 650px;">
                <h2>Designer Form</h2>
                <form action="{{ route('save_image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="username">Product Name:</label>
                    <input type="text" id="designername" name="designer_name" required class="form-control mb-2">

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required class="form-control mb-2">

                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required class="form-control mb-2">

                    <label for="description">Dress Description:</label>
                    <textarea id="description" name="description" rows="4" class="form-control mb-2"></textarea>

                    <label for="price">Price:</label>
                    <input type="number" id="number" name="price" required class="form-control mb-2">

                    <label for="category">Category:</label>
                            <select name="category" class="form-select mb-2">
                                <option value="">Select Category</option>
                                <option value="Cultural">Cultural</option>
                                <option value="Western">Western</option>
                            </select>


                    <label for="profile-picture">Picture:</label>
                    <input type="file" id="profile-picture" name="profile_picture" class="form-control mb-2">

                    <button type="submit" class="btn btn-dark mt-3" style="background-color: black;">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.dropdown-item').forEach(function(item) {
    item.addEventListener('click', function(event) {
        event.preventDefault();
        var dropdownMenu = item.getAttribute('data-dropdown');
        var dropdownToggle = document.getElementById(dropdownMenu);
        dropdownToggle.textContent = item.textContent;
    });
});
        </script>
@endsection
