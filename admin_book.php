<?php
session_start();
require_once "./functions/admin.php";
$title = "List book";
require_once "./template/header.php";
require_once "./functions/database_functions.php";
$conn = db_connect();

// Handle the search
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $result = searchBooks($conn, $search);
} else {
    $result = getAll($conn);
}
// ./functions/database_functions.php

// Function to search for books by title or author
function searchBooks($conn, $search)
{
    $search = mysqli_real_escape_string($conn, $search);
    $query = "SELECT * FROM books WHERE book_title LIKE '%$search%' OR book_author LIKE '%$search%'";
    $result = mysqli_query($conn, $query);
    return $result;
}
?>

<h4 class="fw-bolder text-center">Book List</h4>
<center>
    <hr class="bg-warning" style="width: 5em; height: 3px; opacity: 1">
</center>

<!-- Success message -->
<?php if (isset($_SESSION['book_success'])) : ?>
    <div class="alert alert-success rounded-0">
        <?= $_SESSION['book_success'] ?>
    </div>
    <?php
    unset($_SESSION['book_success']);
endif;
?>

<!-- Search form -->
<form class="mb-4">
    <div class="input-group">
        <input type="text" class="form-control rounded-0" name="search" placeholder="Search for books">
        <button class="btn btn-primary rounded-0" type="submit">Search</button>
    </div>
</form>

<div class="card rounded-0 fade-in">
    <div class="card-body">
        <!-- ... your existing table code ... -->
    </div>
</div>

<div class="card rounded-0">
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-striped table-bordered">
                <colgroup>
                    <col width="10%">
                    <col width="15%">
                    <col width="15%">
                    <col width="10%">
                    <col width="15%">
                    <col width="10%">
                    <col width="15%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Publisher</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr class="fade-in-row">
                            <td class="px-2 py-1 align-middle"><a href="book.php?bookisbn=<?php echo $row['book_isbn']; ?>" target="_blank"><?php echo $row['book_isbn']; ?></a></td>
                            <td class="px-2 py-1 align-middle"><?php echo $row['book_title']; ?></td>
                            <td class="px-2 py-1 align-middle"><?php echo $row['book_author']; ?></td>
                            <td class="px-2 py-1 align-middle"><?php echo $row['book_image']; ?></td>
                            <td class="px-2 py-1 align-middle"><p class="text-truncate" style="width:15em"><?php echo $row['book_descr']; ?></p></td>
                            <td class="px-2 py-1 align-middle"><?php echo $row['book_price']; ?></td>
                            <td class="px-2 py-1 align-middle"><?php echo getPubName($conn, $row['publisherid']); ?></td>
                            <td class="px-2 py-1 align-middle text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="admin_edit.php?bookisbn=<?php echo $row['book_isbn']; ?>" class="btn btn-sm rounded-0 btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="admin_delete.php?bookisbn=<?php echo $row['book_isbn']; ?>" class="btn btn-sm rounded-0 btn-danger" title="Delete" onclick="if (confirm('Are you sure to delete this book?') === false) event.preventDefault()"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
if (isset($conn)) {
    mysqli_close($conn);
}
require_once "./template/footer.php";
?>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    tr.fade-in-row {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
    }

    tr.fade-in-row.active {
        opacity: 1;
        transform: translateY(0);
    }

    tr:hover {
        background-color: #f0f0f0;
    }

    .btn-group {
        display: flex;
        justify-content: center;
    }

    .btn {
        margin: 5px;
        font-size: 16px;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
        border-radius: 3px;
        transition: background-color 0.3s, color 0.3s;
    }

    .btn:hover {
        background-color: #007bff;
        color: #fff;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const rows = document.querySelectorAll("tbody tr");

        rows.forEach((row) => {
            row.addEventListener("mouseover", () => {
                row.style.backgroundColor = "#f0f0f0";
            });

            row.addEventListener("mouseout", () => {
                row.style.backgroundColor = "";
            });
        });

        const deleteButtons = document.querySelectorAll(".btn-danger");

        deleteButtons.forEach((button) => {
            button.addEventListener("click", (e) => {
                if (!confirm("Are you sure to delete this book?")) {
                    e.preventDefault();
                }
            });
        });

        // Add fade-in animation to table rows
        setTimeout(() => {
            rows.forEach((row, index) => {
                setTimeout(() => {
                    row.classList.add("active");
                }, index * 100);
            });
        }, 500);
    });
</script>
