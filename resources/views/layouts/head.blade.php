<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
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

        .btn-outline-secondary {
            background-color: #b5c99a;
            color: black;
        }

        .navbar-brand {
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
        }

        .signin {
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
            /* Smooth transition for motion effect */
        }

        .custom-card:hover img {
            transform: scale(1.1);
            /* Scale up the image on hover */
        }

        .card-bottom-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.6);
            /* Semi-transparent black background */
            color: white;
            text-align: center;
            padding: 20px;
        }

        .empty {
            height: 20px;
            width: 100%;
        }

        .emptytwo {
            height: 20px;
            width: 100%;
        }
    </style>
</head>
