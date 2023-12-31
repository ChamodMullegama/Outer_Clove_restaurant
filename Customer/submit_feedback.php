<?php
require '../Db/connection.php';
include './customer_home.php';
?>

<style>
  body {
    font-family: Arial, sans-serif;
    background-color: bisque;
    margin: 0;
    padding: 0;

  }

  .section_book_topic {
    text-align: center;
    margin: 30px 0;
    margin-left: 10%;
    text-transform: capitalize;
    font-size: large;
    border: 1px solid black;
    border-radius: 10px;
    background-color: #871313;
    width: 80%;
  }

  .section_book_topic h1 {
    font-size: 32px;
    color: #333;
    margin-bottom: 10px;
    color: white;
  }

  .fb-form {
    width: 400px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .form-group {
    display: flex;
    flex-direction: column;
  }

  h2 {
    margin-bottom: 20px;
    text-align: center;
  }

  .form-control {
    margin-bottom: 15px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
  }

  textarea {
    resize: vertical;
    height: 100px;
  }

  .rating {
    margin-bottom: 15px;
  }

  .fa-star {
    font-size: 20px;
    color: #FFD700;
    cursor: pointer;
  }

  .btn-primary {
    background-color: #45a049;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .btn-primary:hover {
    background-color: #0056b3;
  }
</style>


<div class="section_book_topic">
  <h1>Customer Feedback </h1>
</div>
<div class='fb-form'>
  <form action='./submit_feedback_inc.php' class='form-group' method="post">
    <h2>Tell us what you think</h2>
    <input class='form-control' placeholder='Name' type='text' name="name">
    <input class='form-control' placeholder='Email' type='email' name="email">
    <textarea class='form-control' id='fb-comment' name='comment' placeholder='Tell us what you think'></textarea>
    <div class='rating'>
      <i class='fa fa-star'></i>
      <i class='fa fa-star'></i>
      <i class='fa fa-star'></i>
      <i class='fa fa-star'></i>
      <i class='fa fa-star'></i>
    </div>
    <input type="hidden" class="form-control" id="rating" name="rating">
    <input class='form-control btn btn-primary' type='submit' name="submit" onclick="showAlert()">
    <script>
      function showAlert() {
        alert("Feedback submitted successfully!");
      }
    </script>
  </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
  $(document).ready(function() {
    $('.rating .fa-star').click(function() {
      $('.rating .active-rating').removeClass('active-rating');
      $(this).toggleClass('active-rating');
      var selectedStars = $('.rating .active-rating').length;
      $('#starRating').val(selectedStars);
    });
  });
</script>
<?php
include '../footer.php';
?>