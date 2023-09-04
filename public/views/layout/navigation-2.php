<?php
session_start();
?>

<header>
    <div class="logo">
        <img alt="logo" src="public/img/blackLogo.svg" />
    </div>
    <h2 class="user-greeting">Witaj, <?php echo $_SESSION['username'] ?></h2>
    <?php
    if ($_SESSION['user_role'] === "admin") : ?>
        <nav>
            <ul>
                <li><a class="navLink" href="/">Main</a></li>
                <li><a href="/cars/add">Add new car</a></li>
                <li><a href="/users">Users</a></li>
                <li><a class="sign-in" href="/logout">Logout</a></li>
            </ul>
        </nav>
    <?php else : ?>
        <nav>
            <ul>
                <li><a class="navLink" href="/">Main</a></li>
                <li><a href="/cars">Cars</a></li>
                <li><a href="/faq">FAQs</a></li>
                <li><a href="/contact">Contact us</a></li>
                <li><a class="sign-in" href="/logout">Logout</a></li>
            </ul>
        </nav>
    <?php endif; ?>
</header>