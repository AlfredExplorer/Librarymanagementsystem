<?php
global $link;
include "connection.php";
// Check if 'id' is set in the query string
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $a = date('d-m-Y');

    // Update return date for the book in the database
    $res = mysqli_query($link, "UPDATE issue_books SET books_return_date = '$a' WHERE id = '$id'");

    $book_name = '';
    // Fetch book name for the given book ID
    $res = mysqli_query($link, "SELECT * FROM issue_books WHERE id = '$id'");
    while ($row = mysqli_fetch_array($res)) {
        $book_name = $row['books_name'];
    }

    // Update available quantity for the returned book
    mysqli_query($link, "UPDATE add_books SET available_qty = available_qty + 1 WHERE books_name = '$book_name'");

    // Redirect after processing
    echo '<script type="text/javascript">window.location.href = "return_book.php";</script>';
} else {
    // Handle case where 'id' is not set
    echo "Error: Book ID ('id') is required in the URL.";
}