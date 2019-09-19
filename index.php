<?php
    require_once("config.php");

    session_start();
    Routeur::route();
?>