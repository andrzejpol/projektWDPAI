<?php
session_start();
session_unset();
session_destroy();
$url = "http://$_SERVER[HTTP_HOST]";
header("Location: {$url}/");
