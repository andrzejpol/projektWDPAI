<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" name="viewport" />
  <meta content="ie=edge" http-equiv="X-UA-Compatible" />
  <link rel="stylesheet" href="public/css/style.css?v=<?php echo time(); ?>" type="text/css" />
  <title>Register Page</title>
  <script type="text/javascript" src="public/js/signup.js" defer></script>
</head>

<body>
  <div class="wrapper">
    <?php include('public/views/layout/navigation.php') ?>
    <div class="login-wrapper">
      <div class="loginModal-wrapper">
        <div class="logo-and-review">
          <div class="login-logo">
            <img alt="logo" src="public/img/whiteLogo.svg" />
          </div>
          <div class="client-opinion">
            <div class="stars">stars</div>
            <p>"Everything went very smoothly. No delay at pick up, car was clean and return arrangements simply and swift."</p>
            <div class="client-data">
              <p>Devon Lane</p>
              <p>London, England</p>
            </div>
          </div>
        </div>
        <div class="login-form">
          <h2>Join Car Rent</h2>
          <p>Flexible rentals, no hidden fees, price match guarantee...</p>
          <form class="loginForm">
            <label for="username">Full name</label>
            <input type="text" id="username" name="username">
            <label for="email">Email address</label>
            <input type="email" id="email" name="email">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" name="confirmPassword" id="confirmPassword">
            <div class="checkbox-wrapper">
              <input type="checkbox" value="agree" id="terms" name="terms" required>
              <label for="terms">By Signin Up I agree with Terms & Conditions</label>
            </div>
            <div class="register-error-message">
              <p id="error"></p>
              <p>
                <span class="bold-message">
                  <?php if (isset($errors)) {
                    foreach ($errors as $error) {
                      echo $error;
                    }
                  }
                  ?>
                </span>
              </p>
            </div>
            <button type="submit">Sign Up</button>
          </form>
        </div>
      </div>
    </div>
    <?php include('public/views/layout/footer.php') ?>
  </div>
</body>

</html>