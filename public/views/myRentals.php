<?php
session_start();
if (!isset($_SESSION['userId'])) {
    $url = "http://$_SERVER[HTTP_HOST]";
    header("Location: {$url}/signin");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" name="viewport" />
    <meta content="ie=edge" http-equiv="X-UA-Compatible" />
    <title>My rentals</title>
    <script type="text/javascript" src="/public/js/carsPage.js" defer></script>
    <link href="public/css/header.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="public/css/footer.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="public/css/myRentals.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="public/css/style2.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="wrapper">
        <?php if (!isset($_SESSION['userId'])) {
            include('public/views/layout/navigation.php');
        } else {
            include('public/views/layout/navigation-2.php');
        }
        ?>
        <main>
            <table>
                <thead>
                    <tr>
                        <th>Car brand</th>
                        <th>Car model</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($rentals)) : ?>
                        <?php foreach ($rentals as $rental) : ?>
                            <tr>
                                <td><?= $rental['brand'] ?></td>
                                <td><?= $rental['model'] ?></td>
                                <td><?= $rental['start_date'] ?></td>
                                <td><?= $rental['end_date'] ?></td>
                                <td><?= $rental['status'] ?></td>
                                <td>
                                    <form method="POST" action="/cancelrent/<?= $rental['car_id'] ?>">
                                        <?php if ($rental['status'] !== "Active") : ?>
                                            <p>No action.</p>
                                        <?php else : ?>
                                            <button type="submit">Return car</button>
                                        <?php endif; ?>
                                    </form>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td>You do not have any rentals.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </main>
        <?php include('public/views/layout/footer.php') ?>
    </div>
</body>

</html>