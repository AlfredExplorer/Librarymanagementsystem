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
                        <h3>Display books</h3>
                    </div>
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search" />
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
                                <h2>Display & search books</D></h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                            <form name="form1" action="" method="post">
                                <input type="text" name="t1" class="form-control" placeholder="Enter book name" required="" >
                                <input type="submit" name="submit1" value="Search books" class="btn btn-primary" >

                            </form>

                                <?php
                                    if(isset($_POST['submit1'])){
                                        $query="select * from add_books where books_name like '%".$_POST['t1']."%'";
                                        $result=mysqli_query($link,$query);
                                        echo "<table class='table table-striped table-bordered'>";
                                        echo "<tr>";
                                        echo "<th>"; echo "Book image"; echo "</th>";
                                        echo "<th>"; echo "Book name"; echo "</th>";
                                        echo "<th>"; echo "Book author"; echo "</th>";
                                        echo "<th>"; echo "Publisher"; echo "</th>";
                                        echo "<th>"; echo "Purchase date"; echo "</th>";
                                        echo "<th>"; echo "Book price"; echo "</th>";
                                        echo "<th>"; echo "Book quantity"; echo "</th>";
                                        echo "<th>"; echo "Available quantity"; echo "</th>";
                                        echo "<th>"; echo "Delete Book"; echo "</th>";
                                        echo "</tr>";

                                        while ($row=mysqli_fetch_array($result)){

                                            echo "<tr>";
                                            echo "<td>"; ?><img src="<?php echo $row["books_image"]; ?>" height="100" width="100"> <?php echo "</td>";
                                            echo "<td>"; echo $row["books_name"]; echo "</td>";
                                            echo "<td>"; echo $row["books_author"]; echo "</td>";
                                            echo "<td>"; echo $row["books_publisher"]; echo "</td>";
                                            echo "<td>"; echo $row["books_purchase_date"]; echo "</td>";
                                            echo "<td>"; echo $row["books_price"]; echo "</td>";
                                            echo "<td>"; echo $row["books_qty"]; echo "</td>";
                                            echo "<td>"; echo $row["available_qty"]; echo "</td>";
                                            echo "<td>"; ?> <a href="delete_books.php?id=<?php echo $row["id"]; ?>">Delete book</a> <?php echo "</td>";
                                            echo "</tr>";
                                        }
                                        echo "</table>";

                                    }
                                    else{

                                    $query="select * from add_books";
                                    $result=mysqli_query($link,$query);
                                    echo "<table class='table table-striped table-bordered'>";
                                    echo "<tr>";
                                    echo "<th>"; echo "Book image"; echo "</th>";
                                    echo "<th>"; echo "Book name"; echo "</th>";
                                    echo "<th>"; echo "Book author"; echo "</th>";
                                    echo "<th>"; echo "Publisher"; echo "</th>";
                                    echo "<th>"; echo "Purchase date"; echo "</th>";
                                    echo "<th>"; echo "Book price"; echo "</th>";
                                    echo "<th>"; echo "Book quantity"; echo "</th>";
                                    echo "<th>"; echo "Available quantity"; echo "</th>";
                                    echo "<th>"; echo "Delete Book"; echo "</th>";
                                    echo "</tr>";

                                    while ($row=mysqli_fetch_array($result)){

                                    echo "<tr>";
                                    echo "<td>"; ?><img src="<?php echo $row["books_image"]; ?>" height="100" width="100"> <?php echo "</td>";
                                    echo "<td>"; echo $row["books_name"]; echo "</td>";
                                    echo "<td>"; echo $row["books_author"]; echo "</td>";
                                    echo "<td>"; echo $row["books_publisher"]; echo "</td>";
                                    echo "<td>"; echo $row["books_purchase_date"]; echo "</td>";
                                    echo "<td>"; echo $row["books_price"]; echo "</td>";
                                    echo "<td>"; echo $row["books_qty"]; echo "</td>";
                                    echo "<td>"; echo $row["available_qty"]; echo "</td>";
                                    echo "<td>"; ?> <a href="delete_books.php?id=<?php echo $row["id"]; ?>">Delete book</a> <?php echo "</td>";
                                    echo "</tr>";
                                    }
                                    echo "</table>";
                                    }
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

