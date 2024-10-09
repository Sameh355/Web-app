<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Service - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7ff;
            color: #333;
        }

        .hero-section {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column; 
            height: 90vh;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            text-align: center;
        }

        h1 {
            font-size: 3.5rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            margin-bottom: 1rem;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #e9e9e9;
        }

        .btn-lg {
            padding: 10px 30px;
            font-size: 1.1rem;
            font-weight: bold;
            border-radius: 30px;
            margin: 10px; 
        }

        .btn-outline-light {
            color: white;
            border-color: white;
        }

        .btn-outline-light:hover {
            background-color: white;
            color: #007bff;
        }

        footer {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            font-size: 1.1rem;
            position: relative;
            text-align: center;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px; 
        }

        footer p {
            margin: 0;
            padding: 5px;
        }

        nav .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #007bff;
        }

        nav .navbar-nav .nav-link {
            font-size: 1.1rem;
            margin-right: 10px;
            color: #333;
        }

        nav .navbar-nav .nav-link:hover {
            color: #007bff;
        }

        .navbar-toggler-icon {
            color: #007bff;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }

            p {
                font-size: 1rem;
            }

            .btn-lg {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Fast Delivery</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 hero-text">
                    <h1>Welcome to Fast Delivery Service</h1>
                    <p>Your most reliable partner for deliveries</p>
                    <a href="login.php" class="btn btn-light btn-lg">Login</a>
                    <a href="signup.php" class="btn btn-outline-light btn-lg">Register</a>
                </div>
            </div>
            <footer class="footer text-center">
                <div class="container">
                    <p>&copy; 2024 Fast Delivery Service. <strong>All rights reserved.</strong></p>
                </div>
            </footer>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
