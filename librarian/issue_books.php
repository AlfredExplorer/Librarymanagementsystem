<?php
global $link;
include "connection.php";
include "header.php";
?>
        <!-- page content area main -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Books lending</h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search" >
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for..." >
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
                                <h2>Issue books</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form name="form1" action="" method="post">
                                    <table>
                                        <tr>Enrollment No.:
                                            <td>
                                                <select name="enr" class="form-control select-picker">
                                                    <?php
                                                    $res = mysqli_query($link, "select enrollment from student_registration");
                                                    while ($row = mysqli_fetch_array($res))
                                                    {
                                                        echo "<option>";
                                                        echo $row["enrollment"];
                                                        echo "</option>";

                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                               <input type="submit" name="submit1" value="Search"
                                                      class="form-control btn-primary" >
                                            </td>
                                        </tr>

                                    </table>

                                    <?php
                                    if (isset($_POST["submit1"]))
                                    {   $res5=mysqli_query($link,"select * from student_registration where enrollment = '$_POST[enr]'");
                                        while ($row5 = mysqli_fetch_array($res5))
                                        {
                                            $firstname = $row5["firstname"];
                                            $lastname = $row5["lastname"];
                                            $username = $row5["username"];
                                            $email = $row5["email"];
                                            $contact = $row5["contact"];
                                            $sem = $row5["sem"];
                                            $enrollment = $row5["enrollment"];

                                        } ?>
                                        <table class = "table table-bordered">
                                        <tr>
                                            <td>
                                                <input type = "text" class="form-control" placeholder="Enrollment No"
                                                           name="enrollment_no" value="<?php echo $enrollment;?>" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Student name"
                                                           name="student_name" value="<?php echo htmlspecialchars(trim($firstname . ' ' . $lastname));?>" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Student contact"
                                                           name="student_contact" value="<?php echo $contact;?>" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Student email"
                                                           name="student_email" value="<?php echo $email;?>" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Student sem"
                                                       name="student_sem" value="<?php echo $sem;?>" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select name="book_name" class="form-control select-picker" >
                                                    <option value = "">Select book</option>
                                                    <?php
                                                        $res = mysqli_query($link, "select books_name from add_books");
                                                        while ($row = mysqli_fetch_array($res))
                                                        {
                                                            echo "<option>";
                                                            echo $row['books_name'];
                                                            echo "</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="books issue date"
                                                           name="bk_issue_date" value="<?php echo date('d-m-Y');?>" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="student username"
                                                       name="student_username" value="<?php echo $username;?>" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="submit" name="submit2" class="form-control btn btn-primary"
                                                           value="Issue Book" style="background-color: #286090; color: white;" >
                                            </td>
                                        </tr>
                                        </table>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if (isset($_POST["submit2"]))
                                    {   $qty = 0;
                                        $res = mysqli_query($link, "select * from add_books where books_name = '$_POST[book_name]' ");
                                        while ($row = mysqli_fetch_array($res))
                                        {
                                            $qty = $row['available_qty'];
                                        }
                                        if ($qty == 0)
                                        {
                                            echo "<div class='alert alert-danger'>This book is not available in stock!</div>";
                                        }
                                        else
                                        {
                                            /*echo "<pre>";
                                            print_r($_POST); // Check what data is coming from the form
                                            echo "</pre>";*/
                                            // Retrieve form data safely
                                            $enrollment_no = $_POST['enr'];
                                            $student_name = $_POST['student_name'];
                                            $student_sem = $_POST['student_sem'];
                                            $student_contact = $_POST['student_contact'];
                                            $student_email = $_POST['student_email'];
                                            $book_name = $_POST['book_name'];
                                            $bk_issue_date = $_POST['bk_issue_date'];
                                            $student_username = $_POST['student_username'];

                                            // Validate required fields
                                            if (
                                                    empty($enrollment_no) || empty($student_name) || empty($student_sem) ||
                                                    empty($student_contact) || empty($student_email) || empty($book_name) || empty($bk_issue_date) || empty($student_username)
                                                )   {
                                                        echo "<div class='alert alert-danger'>All fields are required. Please fill in all fields!</div>";
                                                        return;
                                                    }

                                            // Prepare the SQL query to insert the submitted form data into the database
                                            $query = "INSERT INTO issue_books (
                                                student_enrollment,
                                                student_name, 
                                                student_sem, 
                                                student_contact, 
                                                student_email, 
                                                books_name, 
                                                books_issue_date,
                                                books_return_date,
                                                student_username
                                            ) VALUES (
                                                        '$enrollment_no', 
                                                        '$student_name', 
                                                        '$student_sem', 
                                                        '$student_contact', 
                                                        '$student_email', 
                                                        '$book_name', 
                                                        '$bk_issue_date',
                                                        '',
                                                        '$student_username'
                                                    )";

                                            // Execute the query
                                            $result = mysqli_query($link, $query);

                                            // Check the result and provide feedback
                                            if ($result)
                                                {
                                                echo "<div class='alert alert-success'>Book issued successfully!</div>";
                                                } else {
                                                        echo "<div class='alert alert-danger'>Error issuing book: " . mysqli_error($link) . "</div>";
                                                        }
                                        mysqli_query($link, "update add_books set available_qty = available_qty - 1 where books_name = '$book_name'" );
                                    ?>

                                        <script type="text/javascript">
                                            alert("Book Issued Successfully");
                                            window.location.href = "issue_books.php";
                                        </script>

                                        <?php
                                        }
                                    }
                                    ?>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page content -->

<?php
include "footer.php";
?>