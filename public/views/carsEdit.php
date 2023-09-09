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
                        <option value="available">Available</option>
                        <option value="rented">Rented</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                    <input type="file" id="carImage" name="file" accept="image/*" required>

                    <input type="submit" value="Dodaj Samochód">
                </form>
                <table>
                    <thead>
                        <tr>
                            <th>Car Id</th>
                            <th>Car brand</th>
                            <th>Car model</th>
                            <th>Price per day</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2</td>
                            <td>Ford</td>
                            <td>Focus</td>
                            <td>35$</td>
                            <td>Available</td>
                        </tr>
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