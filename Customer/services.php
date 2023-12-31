<?php
require '../Db/connection.php';
include './customer_home.php';
?>

<section>

<?php
include '../Db/connection.php'; // Include the database connection file

$database = new connection(); // Create an instance of your Database class

try {
   $conn = $database->getConnection();

   // Prepare and execute SQL query to fetch all products
   $select_sql = "SELECT * FROM services";
   $stmt = $conn->prepare($select_sql);
   $stmt->execute();

   // Fetch products data
   $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
   // Handle any potential database errors
   echo 'Error: ' . $e->getMessage();
}
?>

<!-- Your HTML structure for the "About Us" page -->

<section class="services">
    <div class="section-services-topic">
        <h1>Outer Clove Restaurant services</h1>
    </div>
    <div class="services-row">
        <?php $count = 0; ?>
        <?php foreach ($services as $service) : ?>
            <div class="responsive">
                <div class="service">
                    <div class="desc"><?php echo $service['service_name']; ?></div>
                    <a target="_blank" href="<?php echo $service['service_image']; ?>">
                        <img src="<?php echo $service['service_image']; ?>" alt="Gallery Image" class="service-image">
                    </a>
                    <div class="desc"><?php echo $service['service_description']; ?></div>
                </div>
            </div>
            <?php $count++; ?>
            <?php if ($count % 4 == 0) : ?>
                </div><div class="services-row">
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>


<style>
    .section-services-topic {
        text-align: center;
        margin: 30px 0;
        text-transform: capitalize;
        font-size: large;
        border: 1px solid black;
        border-radius: 10px;
        background-color: #871313;
        color: white;
    }

    .section-services-topic h1 {
        font-size: 32px;
        margin-bottom: 10px;
    }

    section {
        width: 90%;
        margin-left: 5%;
    }

    .services-row {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 3%;
    }

    .service {
        margin-top: 20px;
        border: 2px solid black;
        border-radius: 10px;
        overflow: hidden;
        background-color: rgba(0, 0, 0, 0.1);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease-in-out;
    }

    .service:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        transform: scale(1.1);
        transition: transform 0.4s ease-in-out;
    }

    .service-image {
        width: 275px;
        height: 250px;
        display: block;
        transition: transform 0.3s ease-in-out;
    }

    .desc {
        padding: 15px;
        text-align: center;
        font-size: 14px;
        color: black;
        font-weight: 1000;
        text-transform: capitalize;
    }

    .responsive {
        width: calc(20% - 24px);
        margin: 10px 0;
    }


    .section-services-topic {
        text-align: center;
        margin-bottom: 20px;
    }
    
    .booking {
        width: 50%;
        margin: 0 auto;
        font-family: Arial, sans-serif;
    }

    

    @media only screen and (max-width: 1200px) {
        .responsive {
            width: calc(25% - 15px);
        }
    }

    @media only screen and (max-width: 900px) {
        .responsive {
            width: calc(33.33% - 15px);
        }
    }

    @media only screen and (max-width: 700px) {
        .responsive {
            width: calc(50% - 10px);
        }
    }

    @media only screen and (max-width: 500px) {
        .responsive {
            width: calc(100% - 10px);
        }
    }
    
</style>


</section>
<?php
 include '../footer.php';
 ?>

