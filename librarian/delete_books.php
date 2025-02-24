<?php
include "connection.php";
global $link;

if (isset($_GET['id']))
 {
    $id=$_GET['id'];
    mysqli_query($link,"delete from add_books where id='$id'");
    ?>
    <script type="text/javascript">
    window.location="display_books.php";
    </script>
    <?php
 }
else
 {  ?>
    <script type="text/javascript">
    window.location="display_books.php";
    </script>
    <?php
  }