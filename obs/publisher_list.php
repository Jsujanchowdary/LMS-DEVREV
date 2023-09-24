<?php
  session_start();
  require_once "./functions/database_functions.php";
  $conn = db_connect();

  $query = "SELECT * FROM publisher ORDER BY publisherid";
  $result = mysqli_query($conn, $query);
  if (!$result) {
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }
  if (mysqli_num_rows($result) == 0) {
    echo "Empty publisher! Something wrong! Check again";
    exit;
  }

  $title = "List Of Publishers";
  require "./template/header.php";
?>

<!-- Add CSS for styling -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
  /* Style for the publisher list */
  .list-group-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s; /* Smooth hover transition */
  }

  /* Style for the badge */
  .badge {
    font-size: 1rem;
    padding: 0.5rem 1rem;
    border-radius: 20px; /* Rounded badge */
    transition: background-color 0.3s; /* Smooth background-color transition */
  }

  body {
    background-image: url('./bootstrap/img/publisherimg.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
  }
</style>

<div class="container mt-4">
  <div class="h5 fw-bolder text-center">List of Publishers</div>
  <hr>
  <div class="list-group">
    <a class="list-group-item list-group-item-action" href="books.php">
      List of All Books
    </a>
    <?php
      while ($row = mysqli_fetch_assoc($result)) {
        $count = 0;
        $query = "SELECT publisherid FROM books";
        $result2 = mysqli_query($conn, $query);
        if (!$result2) {
          echo "Can't retrieve data " . mysqli_error($conn);
          exit;
        }
        while ($pubInBook = mysqli_fetch_assoc($result2)) {
          if ($pubInBook['publisherid'] == $row['publisherid']) {
            $count++;
          }
        }
    ?>
    <a class="list-group-item list-group-item-action publisher-item animate__animated animate__fadeIn" href="bookPerPub.php?pubid=<?php echo $row['publisherid']; ?>">
      <?php echo $row['publisher_name']; ?>
      <span class="badge badge-primary bg-primary rounded-pill"><?php echo $count; ?></span>
    </a>
    <?php } ?>
  </div>
</div>

<?php
  mysqli_close($conn);
  require "./template/footer.php";
?>

<!-- Add JavaScript/jQuery for animations -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Add animation to the publisher items on hover
    $(".publisher-item").hover(
      function() {
        $(this).addClass("animate__pulse"); // Add pulse animation on hover
        $(this).find(".badge").addClass("animate__bounce"); // Add bounce animation to the badge on hover
      },
      function() {
        $(this).removeClass("animate__pulse"); // Remove pulse animation on hover out
        $(this).find(".badge").removeClass("animate__bounce"); // Remove bounce animation on hover out
      }
    );
  });
</script>
