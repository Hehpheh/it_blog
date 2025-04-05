<?php
include "app/href.php";
session_start();

unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['admin']);

header('Location: ' .BASE_URL . '/index.php');