<?php
    if(session_id() == '') { session_start(); }
    unset($_SESSION['sess_user']);
    session_unset();
    session_destroy();
    header("location: login.php"); die();