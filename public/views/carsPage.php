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
  <title>Cars</title>
  <link href="public/css/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
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
      <h1>Cars</h1>
    </main>
    <?php include('public/views/layout/footer.php') ?>
  </div>
</body>

</html>