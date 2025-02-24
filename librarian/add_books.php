<?php
session_start();
global $link;
include "connection.php";
include "header.php";
?>
        <!-- page content area main -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Add books</h3>
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
                                <h2>Add books info</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form name = "form1" action="" method="post" class = "col-lg-6" enctype="multipart/form-data">
                                    <table class = "table table-bordered">
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="books name" name="books_name" required="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Books image
                                                <input type="file" class="form-control" name="f1" required="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="books author name" name="books_author" required="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="books publisher name" name="pubname" required="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="books purchase date" name="bkpurchasedt" required="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="books price" name="bkprice" required="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="books quantity" name="bkqty" required="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="available quantity" name="aqty" required="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="submit" name="submit1" class = "btn btn-primary submit" value="insert books details">
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
    $tm = md5(time());
    $fnm = $_FILES['f1']['name'];
    $dst = "./books_image/" . $tm .$fnm;
    $dst1 = "books_image/" . $tm . $fnm;

    move_uploaded_file($_FILES['f1']['tmp_name'], $dst);

    mysqli_query($link, "insert into add_books (books_name, books_image, books_author, books_publisher, books_purchase_date, books_price, books_qty, available_qty, librarian_username) values('$_POST[books_name]','$dst1','$_POST[books_author]','$_POST[pubname]','$_POST[bkpurchasedt]','$_POST[bkprice]','$_POST[bkqty]','$_POST[aqty]','$_SESSION[librarian]')");

    ?>
    <script type="text/javascript">
        alert("books details added successfully");
        window.location.href = "add_books.php";
    </script>
<?php

}

?>

<?php
include "footer.php";
?>
