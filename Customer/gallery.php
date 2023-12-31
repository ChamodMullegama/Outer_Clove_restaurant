<?php
require '../Db/connection.php';
include './customer_home.php';
?>

<?php

function getGalleryImages()
{
    $database = new connection();
    $conn = $database->getConnection();

    $query = "SELECT * FROM gallery";
    $stmt = $conn->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    $galleryImages = getGalleryImages();
?>


<section class="section_gallery">
    <style>
        .section_gallery_topic {
            text-align: center;
            margin: 30px 0;
            text-transform: capitalize;
            font-size: large;
            border: 1px solid black;
            border-radius: 10px;
            background-color: #871313;

        }

        .section_gallery_topic h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 10px;
            color: white;
        }

        section {

            width: 90%;
            margin-left: 5%;

        }

        .gallery-row {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 3%;
        }

        div.gallery {
            margin-top: 20px;
            border: 2px solid black;
            border-radius: 10px;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }

        div.gallery:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: scale(1.1);
            transition: transform 0.4s ease-in-out;
        }

        img.gallery-image {
            width: 315px;
            height: 250px;
            display: block;
            transition: transform 0.3s ease-in-out;
        }

        div.desc {
            padding: 15px;
            text-align: center;
            font-size: 14px;
            color: black;
            font-weight: 1000;
            font-size: large;
            text-transform: capitalize;
        }

        .responsive {
            width: calc(20% - 24px);
            margin: 10px 0;
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


    <div class="section_gallery_topic">
        <h1>Outer Clove Restaurant Gallery </h1>
    </div>
    <div class="gallery-row">
        <?php $count = 0; ?>
        <?php foreach ($galleryImages as $image) : ?>
            <div class="responsive">
                <div class="gallery">
                    <a target="_blank" href="<?php echo $image['gallery_image']; ?>">
                        <img src="<?php echo $image['gallery_image']; ?>" alt="Gallery Image" class="gallery-image">
                    </a>
                    <div class="desc"><?php echo $image['gallery_discrition']; ?></div>
                </div>
            </div>
            <?php $count++; ?>
            <?php if ($count % 5 == 0) : ?>
    </div>
    <div class="gallery-row">
    <?php endif; ?>
<?php endforeach; ?>
    </div>

</section>
<?php
include '../footer.php';
?>