<?php
session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
  header('location:Front-office/admin/dashboard.php');
}
else {
    header('location:Front-office/index.php');

}

?>
