<?php
  session_start();
  $count = 0;
  // Connect to the database
  
  $title = "Home";
  require_once "./template/header.php";
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $row = select4LatestBook($conn);
?>

<div id="welcomeMessage" class="container text-center mt-5">
  <h1>Namaste! Discover the World of Knowledge at Devrev Library</h1>
</div>

<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <!-- Search bar with autocomplete -->
      <div class="input-group">
        <input type="text" id="searchInput" class="form-control rounded-pill" placeholder="Search for books...">
        <div id="suggestions" class="suggestions input-group-prepend"></div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <!-- Example row of columns -->
  <div class="lead text-center text-dark fw-bolder h4 mt-4">About Us</div>
  <div><p>Welcome to DEVREV Online Book Store, your one-stop destination for all things literature! Whether you're an avid reader, a casual bookworm, or simply on the hunt for your next great read, you've come to the right place. Our virtual shelves are stocked with a diverse selection of books spanning genres, from thrilling mysteries and heartwarming romances to mind-bending science fiction and insightful non-fiction. Dive into the captivating world of words and stories with us, where every page is an adventure waiting to unfold. Explore our curated collections, discover new authors, and embark on literary journeys that will transport you to places you've never been before. At DEVREV, we believe that books have the power to inspire, educate, and entertain, and we're committed to helping you find the perfect book for every mood and occasion. Start your reading adventure today with DEVREV Online Book Store – where every book is a revelation, and every reader is a cherished part of our vibrant community.</p></div>
  <center>
    <hr class="bg-warning" style="width: 5em; height: 3px; opacity: 1">
  </center>
  <div class="row">
    <?php foreach ($row as $book) { ?>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 py-2 mb-2">
        <a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>" class="card rounded-0 shadow book-item text-reset text-decoration-none">
          <div class="img-holder overflow-hidden">
            <img class="img-top" src="./bootstrap/img/<?php echo $book['book_image']; ?>">
          </div>
          <div class="card-body">
            <div class="card-title fw-bolder h5 text-center"><?= $book['book_title'] ?></div>
          </div>
        </a>
      </div>
    <?php } ?>
  </div>
  <div>
        <h2>Vast Selection:</h2>
        <p>With thousands of titles spanning various genres, from classic literature to contemporary bestsellers, we have a book for every taste and interest.</p>
    </div>

    <div>
        <h2>Convenience:</h2>
        <p>Enjoy the ease of browsing and shopping for your favorite books from the comfort of your home. No need to rush to a physical store – your next literary adventure is just a few clicks away.</p>
    </div>

    <div>
        <h2>Competitive Prices:</h2>
        <p>We offer competitive pricing to ensure you get the best value for your money. Explore our special discounts and promotions to make your reading journey even more affordable.</p>
    </div>

    <div>
        <h2>Expert Recommendations:</h2>
        <p>Our passionate team of book enthusiasts curates lists of must-reads and hidden gems, making it easier for you to discover your next great read.</p>
    </div>

    <div>
        <h2>Secure Shopping:</h2>
        <p>Your privacy and security are our top priorities. Rest assured that your personal information and payment details are safe with us.</p>
    </div>

    <div>
        <h2>Fast Shipping:</h2>
        <p>We understand the excitement of receiving a new book. Our efficient shipping process ensures your order reaches you as quickly as possible, so you can start reading sooner.</p>
    </div>

    <div>
        <h2>Easy Returns:</h2>
        <p>We have a hassle-free return policy in case you change your mind or receive a damaged book.</p>
    </div>
    <div>
      <p>
        ___________________________________________________________________________________________________________________
      </p>
      <p>
        ___________________________________________________________________________________________________________________
      </p>
    </div>
  
</div>

<?php
  if (isset($conn)) { mysqli_close($conn); }
  require_once "./template/footer.php";
?>

<!-- Add CSS for styling -->
<style>
  /* Style for suggestions container */
  .input-group-prepend {
    position: absolute;
    z-index: 1000;
  }
  h2 {
            animation: fadeIn 1s ease-in-out;
            font-weight: bold; /* Add bold text */
        }
        p {
            animation: fadeIn 1s ease-in-out;
            font-weight: bold; /* Add bold text */
        }
  .suggestions {
    position: absolute;
    background-color: #fff;
    border: 1px solid #ccc;
    max-height: 150px;
    overflow-y: auto;
    width: 100%;
    z-index: 1000;
    animation: fadeIn 0.3s ease-in-out;
    display: none; /* Initially hidden */
  }

  /* Animation for fading in suggestions */
  @keyframes fadeIn {
    0% { opacity: 0; }
    100% { opacity: 1; }
  }

  /* Background image */
  body {
    background-image: url('./bootstrap/img/background.jpg'); /* Use a relative path */
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed; /* Keeps the background fixed while scrolling */
  }

  /* Style for welcome message */
  #welcomeMessage {
    display: none;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  }
  /* Add this CSS to your existing styles */
  .about-us-text {
  opacity: 0;
  animation: typing 3s steps(30, end), colorChange 3s infinite alternate;
}

@keyframes typing {
  from { width: 0; }
  to { width: 100%; }
}

@keyframes colorChange {
  0% { background-color: #fff; }
  100% { background-color: #f0f0f0; }
}
body {
            background-color: #333;
            color: white;
            font-family: Arial, sans-serif;
        }

        /* Add a subtle animation to the headings */
        h2 {
            animation: fadeIn 1s ease-in-out;
        }

        /* Add a hover effect to links */
        a {
            color: #0077b6;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        a:hover {
            color: #00a1d6;
        }

        /* Define the fadeIn animation */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }


</style>

<!-- Add jQuery for animations -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Show the "About Us" section with animation
    $(".about-us").addClass("show");
  });
  $(document).ready(function() {
    // Show the welcome message
    $("#welcomeMessage").fadeIn();

    // Set a timeout to hide the welcome message after 3 seconds
    setTimeout(function() {
      $("#welcomeMessage").fadeOut();
    }, 4000); // 3000 milliseconds = 3 seconds

    $("#searchInput").keyup(function() {
      var query = $(this).val();
      if (query != '') {
        $.ajax({
          url: "search.php", // Create a PHP script for handling the search
          method: "POST",
          data: { query: query },
          success: function(data) {
            $("#suggestions").html(data);
            $("#suggestions").show(); // Show the suggestions
          }
        });
      } else {
        $("#suggestions").html("").hide(); // Hide the suggestions when input is empty
      }
    });
  });
</script>
