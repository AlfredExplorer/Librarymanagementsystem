<?php
$link = mysqli_connect("localhost","root","mizizi@2");
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_select_db($link, "lms") or die("Database not found.");