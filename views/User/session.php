<?php
error_reporting(E_ALL);
ini_set("display_errors",0);

if (!isset($_SESSION)) {
    session_start();
}