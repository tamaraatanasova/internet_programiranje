<?php

$routes = [
    "/" => __DIR__ . "/../controllers/HomeController.php",
    "/login" => __DIR__. "/../controllers/LoginController.php",
    "/logout" => __DIR__. "/../controllers/LogoutController.php",
    "/register" => __DIR__. "/../controllers/RegisterController.php",
    "/resetpassword" => __DIR__."/../controllers/ResetPasswordController.php",

    "/actions" => __DIR__. "/../controllers/ActionController.php",

    "/sendEmail" => __DIR__. "/../controllers/SendEmailController.php",

    "/admin" => __DIR__."/../controllers/AdminController.php",

];

$requestedPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (array_key_exists($requestedPath, $routes)) {
    $filePath = $routes[$requestedPath];

    if (file_exists($filePath)) {
        require_once $filePath;
    }
}
