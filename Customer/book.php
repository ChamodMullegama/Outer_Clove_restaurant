<?php
include "../Customer/customer_home.php"
?>
<section>
    <style>
         .section-book-topic {
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

        .section-book-topic h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 10px;
            color: white;
        }

        .booking {
            margin: 20px auto;
            width: 500px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            border: 2px solid black;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        input[type="time"],
        input[type="number"],
        textarea,
        select,
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .login-status-message-success {
            font-weight: 300;
            color: #33cc33;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f0fff0;
            transition: opacity 0.3s ease;
        }
    </style>
    <div class="section-book-topic">
        <h1>Booking table</h1>
    </div>

    <div class="booking">
        <form action="./book_inc.php" method="POST">
            <div class="aleart">
                <?php


                if (isset($_SESSION['success'])) {
                    echo '<div class="login-status-message-success">' . $_SESSION['success'] . '</div>';
                    unset($_SESSION['success']);
                }

                ?>
            </div>
            <input type="text" id="name" name="customer_name" placeholder="Name" required><br><br>
            <input type="email" id="email" name="customer_email" placeholder="Email" required><br><br>
            <input type="tel" id="phone" name="customer_phone" placeholder="Phone" required><br><br>
            <input type="date" id="date" name="booking_date" required><br><br>
            <input type="time" id="time" name="booking_time" required><br><br>
            <select name="table_id" class="box" required>
                <option value="table 1">table 1</option>
                <option value="table 2">table 2</option>
                <option value="table 3">table 3</option>
                <option value="table 4">table 4</option>
                <option value="table 5">table 5</option>
                <option value="table 6">table 6</option>
                <option value="table 7">table 7</option>
                <option value="table 8">table 8</option>
            </select>
            <input type="number" id="guests" name="guests" placeholder="Number of Guests" required><br><br>
            <input type="submit" value="submit" name="submit">
        </form>
    </div>
</section>
<?php
include '../footer.php';
?>