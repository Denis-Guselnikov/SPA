<?php
session_start();
include "path.php";

unset($_SESSION['id']);
unset($_SESSION['login']);
header('location: ' . BASE_URL);