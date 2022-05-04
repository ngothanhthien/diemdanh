<?php if(!isset($_SESSION['lecture'])){
    header('Location: ../layouts/login.php');
}