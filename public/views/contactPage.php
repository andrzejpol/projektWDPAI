<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" name="viewport" />
  <meta content="ie=edge" http-equiv="X-UA-Compatible" />
  <title>Contact us</title>
  <link href="public/css/header.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
  <link href="public/css/footer.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
  <link href="public/css/contactPage.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
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
    <main class="contact-page">
      <section class="contact-info">
        <h2>Contact us</h2>
        <ul>
          <li>E-mail address: <a href="mailto:kontakt@example.com">contact@example.com</a></li>
          <li>Phone number: <a href="tel:+123456789">+123 456 789</a></li>
          <li>Address: 123 Main Street, City, Country</li>
        </ul>
      </section>
      <section>
        <h2>Do you have any suggestion?</h2>
        <form action="process_contact.php" method="POST">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" required>
          <label for="email">E-mail address:</label>
          <input type="email" id="email" name="email" required>
          <label for="message">Message:</label>
          <textarea id="message" name="message" rows="4" required></textarea>
          <button type="submit">Send</button>
        </form>
      </section>
    </main>
    <?php include('public/views/layout/footer.php') ?>
  </div>
</body>

</html>