<?php

include './admin_header.php';
?>

<section>
    <style>
        .dashboard-links {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100%;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../Images/fca9333aed226c5c1fad0e665b25ba33.jpg');
            background-size: cover;
            background-repeat: no-repeat
        }

        .dashboard-button {
            margin-bottom: 10px;
            display: block;
            width: 25%;
            margin-left: 3%;
        }

        .dashboard-button a {
            text-decoration: none;
            color: white;
            display: block;

        }

        .dashboard-button a:hover {
            text-decoration: none;
            color: white;
            display: block;
            background-color: rgba(240, 248, 255, 0.001);

        }

        .dashboard-button {
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: center;
        }

        .dashboard-button:hover {
            background-color: #0056b3;
        }

        img {
            background-size: cover;
        }

        p {
            text-align: center;
            font-size: 200PX;
            color: rgba(240, 248, 255, 0.3)
        }
    </style>

    <div class="dashboard-links">
        <p>ADMIN PANEL</p>
        <button class="dashboard-button"><a href="./manage_customer.php">Manage Customer</a></button>
        <button class="dashboard-button"><a href="./manage_users.php">Manage Staff</a></button>
        <button class="dashboard-button"><a href="./manage_product.php">Manage Dishes</a></button>
        <button class="dashboard-button"><a href="./manage_order.php">Manage Order</a></button>
        <button class="dashboard-button"><a href="./manage_services.php">Manage Services</a></button>
        <button class="dashboard-button"><a href="./manage_gallery.php">Manage Gallery</a></button>
    </div>
</section>

</body>

</html>