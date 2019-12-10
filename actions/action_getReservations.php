<?php 
include_once('../config.php');
include_once(ROOT . 'database/db_houses.php');
include_once(ROOT . 'database/db_users.php');

$reservations = getReservations($_GET['houseId'],  $_GET['status']);

?>
<tr>
    <th align="left">Tenant</th>
    <th align="left">Check in date</th>
    <th align="left">Check out date</th>
    <th align="left">Numer of people</th>
</tr>
<?php
foreach($reservations as $reservation) { 
    $tenant = getUserById($reservation['tenantID']);
    ?>

    <tr class="reservation">
        <td>
            <a href="profile.php?Id=<?= $tenant['id'] ?>">
                <b><?= $tenant['firstName'] ?> <?= $tenant['lastName'] ?></b>
            </a>
        </td>
        <td><?= $reservation['startDate'] ?></td>
        <td><?= $reservation['endDate'] ?></td>
        <td><?= $reservation['numberOfPeople'] ?></td>
    </tr>
<?php } ?>