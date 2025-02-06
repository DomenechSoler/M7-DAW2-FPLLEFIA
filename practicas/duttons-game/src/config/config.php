<?php
session_start();

if (!isset($_SESSION['duttons'])) {
    $_SESSION['duttons'] = []; 
}