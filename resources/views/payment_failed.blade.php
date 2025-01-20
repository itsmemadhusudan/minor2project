<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
       .payment-failed-page {
          text-align: center;
          padding: 50px 0;
       }
       .failed-icon {
          font-size: 5rem;
          color: #dc3545;
          margin-bottom: 20px;
        }
         .payment-failed-page h1{
              margin-bottom: 10px;
           }
         .payment-failed-page a{
            color: #007bff;
             text-decoration: none;
            font-weight: 500;
          }
        .payment-failed-page a:hover{
          text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="payment-failed-page">
        <i class="fas fa-times-circle failed-icon"></i>
        <h1>Payment Failed</h1>
        <p>We were unable to process your payment. Please try again.</p>
         <a href="{{route('index')}}">Go to Home Page</a>
    </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
