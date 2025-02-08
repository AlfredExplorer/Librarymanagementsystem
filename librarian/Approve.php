<?php
include "connection.php";
if (!isset($link)) {
    die("Database connection not established.");
}
mysqli_query($link, "update student_registration set status = 'yes' where id = '$_GET[id]'");

?>

<script type="text/javascript">

    window.location.href = "display_student_info.php";
</script>