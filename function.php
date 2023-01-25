<?php
session_start();
include "connect.php";

function tt($value): void
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}

