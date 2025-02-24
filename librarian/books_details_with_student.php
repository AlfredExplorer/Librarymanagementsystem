<?php
include "connection.php";
global $link;
include "header.php";
?>
<!-- page content area main -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3></h3>
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
                    <h2>Books With Details</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php
                    $stmt = $link->prepare("SELECT * FROM add_books");
                    $stmt->execute();
                    $res = $stmt->get_result();
                    echo "<table class='table table-bordered'>";
                    echo "<tr>";
                    $i = 0; // Counter for displaying in groups of 4
                    while ($row = $res->fetch_assoc())
                    {
                    $i++;
                    echo "<td>";
                        echo "<img src='../librarian/" . htmlspecialchars($row['books_image'], ENT_QUOTES, 'UTF-8') . "' width='100' height='100'><br>";
                        echo "<br><b>" . htmlspecialchars($row['books_name'], ENT_QUOTES, 'UTF-8') . "</b><br>";
                        echo "<b>Total books: " . htmlspecialchars($row['books_qty'], ENT_QUOTES, 'UTF-8') . "</b><br>";
                        echo "<b>Available: " . htmlspecialchars($row['available_qty'], ENT_QUOTES, 'UTF-8') . "</b><br>";
                        ?> <a href="all_student_of_this_book.php?books_name=<?php echo $row["books_name"];?>">Student Record of this book</a><?php
                        echo "</td>";

                    if ($i === 4) // After 4 items, move to the next row
                    {
                    echo "</tr><tr>";
                        $i = 0;
                        }
                        }
                        echo "</tr>";
                    echo "</table>";
                    ?>
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