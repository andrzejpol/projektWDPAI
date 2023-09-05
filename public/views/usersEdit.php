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
    <title>Users Edit</title>
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
                <h1 class="table-title">All users</h1>
                <table>
                    <thead>
                        <tr>
                            <th>User Id</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>User Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($users)) : ?>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= $user->getId() ?></td>
                                    <td><?= $user->getUsername() ?></td>
                                    <td><?= $user->getEmail() ?></td>
                                    <td><?= $user->getUserRole() ?></td>
                                    <td>
                                        <form method="POST" action="/deleteUser/<?= $user->getId() ?>">
                                            <button type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td>You do not have any users.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </main>
            <?php include('public/views/layout/footer.php') ?>
        </div>
</body>

</html>