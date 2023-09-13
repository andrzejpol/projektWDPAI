<?php
session_start();
if ($_SESSION['user_role'] !== "admin") {
    $url = "http://$_SERVER[HTTP_HOST]";
    header("Location: {$url}/");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" name="viewport" />
    <meta content="ie=edge" http-equiv="X-UA-Compatible" />
    <title>Cars Edit</title>
    <link href="public/css/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="wrapper">
        <div class="wrapper">
            <?php if (!isset($_SESSION['userId'])) {
                include('public/views/layout/navigation.php');
            } else {
                include('public/views/layout/navigation-2.php');
            }
            ?>
            <main>
                <form class="editCars" action="/addCar" method="POST" ENCTYPE="multipart/form-data">
                    <label for="carBrand">Brand:</label>
                    <input type="text" id="carBrand" name="carBrand" autocomplete="off" required>

                    <label for="carModel">Model:</label>
                    <input type="text" id="carModel" name="carModel" autocomplete="off" required>

                    <label for="pricePerDay">Price p/day:</label>
                    <input type="number" id="pricePerDay" name="carPrice" step="0.10" autocomplete="off" required>

                    <label for="status">Status:</label>
                    <select id="status" name="carStatus" required>
                        <option value="Available">Available</option>
                        <option value="Rented">Rented</option>
                        <option value="Maintenance">Maintenance</option>
                    </select>
                    <input type="file" id="carImage" name="file" accept="image/*" required>

                    <input type="submit" value="Add new car">
                </form>
                <table>
                    <thead>
                        <tr>
                            <th>Car Id</th>
                            <th>Car brand</th>
                            <th>Car model</th>
                            <th>Price per day</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($cars)) : ?>
                            <?php foreach ($cars as $car) : ?>
                                <tr>
                                    <td><?= $car->getId() ?></td>
                                    <td><?= $car->getCarBrand() ?></td>
                                    <td><?= $car->getCarModel() ?></td>
                                    <td><?= $car->getCarPrice() ?></td>
                                    <td><?= $car->getCarStatus() ?></td>
                                    <td><?= $car->getCarImage() ?></td>
                                    <td>
                                        <form method="POST" action="/deleteCar/<?= $car->getId() ?>">
                                            <button type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="7">You do not have any cars.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <p>
                    <?php if (isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </p>
            </main>
            <?php include('public/views/layout/footer.php') ?>
        </div>
</body>

</html>