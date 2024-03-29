<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" name="viewport" />
  <meta content="ie=edge" http-equiv="X-UA-Compatible" />
  <link href="public/css/header.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
  <link href="public/css/mainPage.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
  <link href="public/css/footer.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
  <link href="public/css/style2.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
  <title>Main page</title>
</head>

<body>
  <div class="wrapper">
    <div class="mainPage">
      <?php if (!isset($_SESSION['userId'])) {
        include('public/views/layout/navigation.php');
      } else {
        include('public/views/layout/navigation-2.php');
      }
      ?>
      <section class="form-container">
        <div class="form-wrapper column">
          <div class="text">
            <h2 class="form-title">Pick-up a car!</h2>
            <p class="form-description">Search for your ideal car...</p>
          </div>
          <form>
            <div class="input-location-wrapper column">
              <label class="input-label" for="pick-up-location">Location</label>
              <input id="pick-up-location" name="location" type="text" placeholder="Cracow" />
            </div>
            <button type="submit">Search</button>
          </form>
        </div>
      </section>
      <section class="best-car">
        <h2 class="section-title">Cheap car rentals</h2>
        <div class="cars">
          <div class="car-wrapper">
            <img alt="car" src="public/img/fiat.svg" />
            <div class="details-wrapper">
              <div class="car-details">
                <p class="car-model">Fiat Tipo</p>
                <p class="car-price">Od 200zł/dzień</p>
              </div>
              <button class="book">Book</button>
            </div>
          </div>
          <div class="car-wrapper">
            <img alt="car" src="public/img/fiat.svg" />
            <div class="details-wrapper">
              <div class="car-details">
                <p class="car-model">Fiat Tipo</p>
                <p class="car-price">Od 200zł/dzień</p>
              </div>
              <button class="book">Book</button>
            </div>
          </div>
          <div class="car-wrapper">
            <img alt="car" src="public/img/fiat.svg" />
            <div class="details-wrapper">
              <div class="car-details">
                <p class="car-model">Fiat Tipo</p>
                <p class="car-price">Od 200zł/dzień</p>
              </div>
              <button class="book">Book</button>
            </div>
          </div>
        </div>
      </section>
      <section class="testimonials">
        <h2 class="section-title">Testimonials</h2>
        <div class="opinions">
          <div class="opinion">
            <div class="image">
              <img alt="testimonial-author" src="public/img/testimonial.svg" />
            </div>
            <div class="opinion-details">
              <div class="description-wrapper">
                <p>stars</p>
                <p class="description">"Lorem ipsum dolor sit amet."</p>
              </div>
              <div class="user-info">
                <p class="name">Jenny Wilson</p>
                <p class="town">Cracow</p>
              </div>
            </div>
          </div>
          <div class="opinion">
            <div class="image">
              <img alt="testimonial-author" src="public/img/testimonial.svg" />
            </div>
            <div class="opinion-details">
              <div class="description-wrapper">
                <p>stars</p>
                <p class="description">"Lorem ipsum dolor sit amet."</p>
              </div>
              <div class="user-info">
                <p class="name">Jenny Wilson</p>
                <p class="town">Cracow</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php include('public/views/layout/footer.php') ?>
    </div>
</body>

</html>