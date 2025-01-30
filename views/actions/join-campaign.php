<?php
namespace App;

use App\Classes\Database;
use App\Classes\Query;
use App\Classes\SessionManager;
use App\Classes\Redirect;

SessionManager::start();

if (!SessionManager::has('user_id')) {
    die("Мора да се најавите.");
}

$userID = SessionManager::get('user_id'); 


$db = (new Database())->getConnection();
$query = new Query($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['campaign_id'])) {
    $campaignID = intval($_POST['campaign_id']); 

    $campaign = $query->find('campaigns', $campaignID, 'CampaignID', true);

    if (!$campaign) {
        $message = "Кампањата не постои.";
        $messageType = "danger"; 
    } else {

        $currentDate = date("Y-m-d");
        if ($campaign['EndDate'] < $currentDate) {
            $message = "Кампањата е веќе завршена.";
            $messageType = "warning"; 
        } else {
            $user = $query->find('users', $userID, 'UserID', true);

            if (!$user) {
                $message = "Корисникот не постои.";
                $messageType = "danger"; 
            } else {
                
                $checkRegistration = $query->find('campaignbeneficiaries', $campaignID . ',' . $userID, 'CampaignID,UserID');

                if ($checkRegistration) {
                    $message = "Веќе сте пријавени за оваа кампања.";
                    $messageType = "danger"; 
                } else {
                    
                    $data = [
                        'CampaignID' => $campaignID,
                        'UserID' => $userID
                    ];
                    $query->insert('campaignbeneficiaries', $data);

                    
                    $query->update('campaigns', ['RegisteredUsers' => $campaign['RegisteredUsers'] + 1], ['CampaignID' => $campaignID]);

                    $message = "Успешно се пријавивте за кампањата!";
                    $messageType = "success"; 
                }
            }
        }
    }
} else {
    $message = "Невалидно барање.";
    $messageType = "danger";
}

?>

<!DOCTYPE html>
<html lang="mk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Пријавување за Кампања</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Пријавување за Кампања</h1>

    <?php if (isset($message)): ?>
        <div class="alert alert-<?= $messageType; ?> text-center">
            <?= htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="" class="mt-4">
        <div class="mb-3">
            <label for="campaign_id" class="form-label">ID на Кампањата</label>
            <input type="number" class="form-control" id="campaign_id" name="campaign_id" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Пријави се</button>
    </form>

    <div class="mt-3">
        <a href="./campaigns-read.php" class="btn btn-secondary w-100">Назад до Кампањи</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
