<?php

// use App\Classes\SessionManager;
// use App\Classes\Redirect;

// SessionManager::start();

// if (!SessionManager::has('user_id')) {
//     Redirect::redirect('/login');
// }

// $user_id = SessionManager::get('user_id');
?>

<?php require_once __DIR__.'/partials/header.partials.php'; ?>

    <!-- Navbar -->
    <?php require_once __DIR__.'/partials/navbar.partials.php'; ?>

   
    <!-- Hero Section -->
    <?php require_once __DIR__.'/partials/hero.partials.php'; ?>
   

    <!-- About Section -->
    <?php require_once __DIR__.'/partials/about.partials.php'; ?>
    

    <!-- Features Section -->
    <?php require_once __DIR__.'/partials/features.partials.php'; ?>

    

    <!-- Contact Section -->
    <?php require_once __DIR__.'/partials/contact.partials.php'; ?>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Трекер за хуманитарни акции. Сите права задржани.</p>
    </footer>

</body>
</html>
