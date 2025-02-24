<?php
session_start();
include "connection.php";
global $link;
include "header.php";
?>
<!-- page content area main -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Compose Message</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search" />
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for..." />
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row" style="min-height:500px">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Send Message To Student</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form name = "form1" action="" method="post" class = "col-lg-6" enctype="multipart/form-data">
                        <table class = "table table-bordered">
                            <tr>
                                <td>
                                    <select name = "dusername" class = "form-control">
                                        <option value = "">Select Student</option>
                                        <?php
                                        $sql = "SELECT * FROM student_registration";
                                        $result = mysqli_query($link, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                           ?><option value="<?php echo htmlspecialchars($row["username"], flags: ENT_QUOTES,encoding: 'UTF-8');?>">
                                            <?php echo htmlspecialchars( $row["username"]."(". $row["enrollment"] .")", flags: ENT_QUOTES,encoding: 'UTF-8');?>
                                            </option><?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" name="title" placeholder="Enter title"> </td>

                            </tr>
                            <tr>
                                <td>
                                    <textarea rows="5" cols="10" class="form-control" name="message" placeholder="Enter message">
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" class="btn btn-success" name="submit1" value="Send Message">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- page content -->
<?php
if (isset($_POST['submit1'])) {
    // Validate session
    if (!isset($_SESSION['librarian'])) {
        die('Librarian not logged in.');
    }

    // Sanitize and validate inputs
    $dusername = trim($_POST['dusername']);
    $title = trim($_POST['title']);
    $message = trim($_POST['message']);
    $susername = $_SESSION['librarian'];
    $seen = 'n';

    if (empty($dusername) || empty($title) || empty($message)) {
        die('All fields are required.');
    }

    if (strlen($title) > 255) {
        die('Title must be less than 255 characters.');
    }

    // Use prepared statements for secure insertion
    $stmt = $link->prepare("INSERT INTO messages (susername, dusername, title, msg, seen) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        error_log("Database statement preparation error: " . $link->error);
        die('An error occurred. Please try again later.');
    }

    // Bind and execute the statement
    $stmt->bind_param("sssss", $susername, $dusername, $title, $message, $seen);

    if ($stmt->execute()) {
        echo 'Message sent successfully!';
    } else {
        error_log("Database insert error: " . $stmt->error);
        die('An error occurred while sending your message. Please try again later.');
    }

    $stmt->close();

}
?>

<?php
include "footer.php";
?>