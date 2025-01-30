<!DOCTYPE html>
<html lang="mk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управување со хуманитарни акции</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/56e750abfb.js" crossorigin="anonymous"></script>
    <style>
        .container {
            margin-top: 30px;
        }
        .nav-conn.active {
            font-weight: bold;
        }
    </style>
</head>
<body>
        <div class="m-4">
            <a href="/"><i class="fa-solid fa-arrow-left fa-2xl"></i></a>
        
        </div>

    <div class="container">
        <h1 class="text-center">Управување со хуманитарни акции</h1>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="?page=create">Креирај акција</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=active">Преглед на активни акции</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=join">Пријави се на акција</a>
            </li>
        </ul>

        <div class="tab-content mt-4">
            <?php
            // Вчитување на различни функционалности базирани на избор
            $page = $_GET['page'] ?? 'create';

            switch ($page) {
                case 'create':
                    include 'campaigns-create.php'; // Страница за креирање акција
                    break;
                case 'active':
                    include 'campaigns-read.php'; // Страница за активни акции
                    break;
                case 'join':
                    include 'join-campaign.php'; // Страница за пријавување
                    break;
                default:
                    echo "<p>Страницата не постои.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>