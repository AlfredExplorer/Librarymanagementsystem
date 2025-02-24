<?php
include "header.php";
include "connection.php";
global $link;
?>
<!-- page content area main -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3></h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
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
                        <h2>Search book</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form name="form1" action="" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td><input type="text" name="t1" class="form-control" placeholder="Enter book name" required></td>
                                <td><input type="submit" name="submit1" value="Search book" class="form-control btn btn-primary"> </td>
                                </tr>
                            </table>

                        <?php

                        if (isset($_POST['submit1']))
                        {
                            // Sanitize user input
                            $bookName = htmlspecialchars($_POST['t1'] ?? '', ENT_QUOTES, 'UTF-8');

                            // Prepare the SQL query with placeholder
                            $stmt = $link->prepare("SELECT * FROM add_books WHERE books_name LIKE ?");
                            if ($stmt===false)
                                {
                                die("Error preparing statement: " . $link->error); //Debugging
                                }
                            // Bind the parameter to the query
                            $searchTerm = "%" . $bookName . "%"; // Add wildcards for a partial match
                            $stmt->bind_param("s", $searchTerm); // Bind one string parameter

                            // Execute the query
                            if ($stmt->execute())
                            {
                                $res = $stmt->get_result();

                                // Display results
                                echo "<table class='table table-bordered'>";
                                echo "<tr>";
                                $i = 0; // Counter for displaying in groups of 4
                                while ($row = $res->fetch_assoc())
                                {
                                    $i++;
                                    echo "<td>";
                                    echo "<img src='../librarian/" . htmlspecialchars($row['books_image'], ENT_QUOTES, 'UTF-8') . "' width='100' height='100'><br>";
                                    echo "<b>" . htmlspecialchars($row['books_name'], ENT_QUOTES, 'UTF-8') . "</b><br>";
                                    echo "<b>Available: " . htmlspecialchars($row['available_qty'], ENT_QUOTES, 'UTF-8') . "</b>";
                                    echo "</td>";

                                        if ($i === 4) // After 4 items, move to the next row
                                        {
                                        echo "</tr><tr>";
                                        $i = 0;
                                        }
                                }
                                echo "</tr>";
                                echo "</table>";
                            } else {
                                echo "Error executing query:" . $stmt->error;
                                }
                        $stmt->close(); // Clean up
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

