<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
       .payment-success-page {
          text-align: center;
          padding: 50px 0;
       }
      .success-icon {
          font-size: 5rem;
          color: #28a745; /* Green color */
          margin-bottom: 20px;
      }
      .payment-success-page h1{
          margin-bottom: 10px;
      }

      .payment-success-page a{
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
      }
      .payment-success-page a:hover{
        text-decoration: underline;
      }

    </style>
</head>
<body>
    <div class="payment-success-page">
        <i class="fas fa-check-circle success-icon"></i>
        <h1>Payment Successful</h1>
        <p>Thank you for your order! Your payment has been processed successfully.</p>
        <a href="{{route('index')}}">Go to Home Page</a>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>