<!DOCTYPE html>
<html lang="mk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Почетна</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Стилизација останува иста */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .navbar {
            background-color: #2c3e50;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #ecf0f1 !important;
            transition: color 0.3s;
        }
        .navbar-nav .nav-link:hover {
            color: #1abc9c !important;
        }
        .hero {
            background: linear-gradient(to right, #1abc9c, #16a085);
            color: white;
            padding: 120px 20px;
            text-align: center;
            transition: background 0.5s;
            position: relative;
        }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            animation: fadeInUp 1s ease-out;
        }
        .hero p {
            font-size: 1.25rem;
            margin-bottom: 30px;
            animation: fadeInUp 1.5s ease-out;
        }
        .hero .btn {
            background-color: #ecf0f1;
            color: #2c3e50;
            border-radius: 30px;
            padding: 12px 25px;
            font-size: 1.1rem;
            text-transform: uppercase;
            font-weight: bold;
            transition: background 0.3s, transform 0.3s;
        }
        .hero .btn:hover {
            background-color: #16a085;
            transform: translateY(-3px);
        }
        /* Стил и анимации за ID */
        .user-id {
            font-size: 2.5rem;
            color: #ecf0f1;
            background: rgba(0, 0, 0, 0.3);
            padding: 15px 30px;
            border-radius: 10px;
            display: inline-block;
            animation: zoomIn 1s ease-in-out, glow 2s infinite alternate;
        }
        @keyframes zoomIn {
            from {
                transform: scale(0.5);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
        @keyframes glow {
            from {
                box-shadow: 0 0 10px #1abc9c;
            }
            to {
                box-shadow: 0 0 20px #16a085;
            }
        }
        .section-title {
            text-align: center;
            margin: 40px 0;
            color: #34495e;
            font-size: 2.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
    </style>
</head>
<body>