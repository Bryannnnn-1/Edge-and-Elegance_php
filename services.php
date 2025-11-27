<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - Edge and Elegance</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/services.css">
    <link rel="stylesheet" href="app.css">
</head>
<body>
    <header>
        <?php
            include("html/header.html")
        ?>
    </header>

   <section class="service-hero d-flex align-items-center text-center text-light">
    <div class="container py-5">
        <h1 class="fw-bold mb-3 display-4">Our Services</h1>
        <p class="lead mb-4 fs-4">
            Professional hair care services tailored to your unique style and needs.
        </p>
    </div>
    </section>

    <div class="container my-5">

        <?php 
            $servicesData = [
                [
                    "category" => "Haircuts",
                    "services" => [
                        ["id" => 1, "name" => "Women's Haircut", "duration" => 45, "price" => 50],
                        ["id" => 2, "name" => "Men's Haircut", "duration" => 30, "price" => 30],
                        ["id" => 3, "name" => "Children's Haircut", "duration" => 30, "price" => 25],
                    ]
                ],
                [
                    "category" => "Colouring",
                    "services" => [
                        ["id" => 4, "name" => "Full Colour", "duration" => 90, "price" => 85],
                        ["id" => 5, "name" => "Root Touch-Up", "duration" => 60, "price" => 65],
                        ["id" => 6, "name" => "Highlights (Full)", "duration" => 120, "price" => 120],
                        ["id" => 7, "name" => "Highlights (Partial)", "duration" => 90, "price" => 90],
                    ]
                ],
                [
                    "category" => "Styling",
                    "services" => [
                        ["id" => 8, "name" => "Blowout", "duration" => 30, "price" => 35],
                        ["id" => 9, "name" => "Special Event Styling", "duration" => 60, "price" => 60],
                        ["id" => 10, "name" => "Bridal Hair", "duration" => 90, "price" => 100],
                    ]
                ],
                [
                    "category" => "Treatments",
                    "services" => [
                        ["id" => 11, "name" => "Deep Conditioning", "duration" => 30, "price" => 40],
                        ["id" => 12, "name" => "Keratin Treatment", "duration" => 180, "price" => 250],
                        ["id" => 13, "name" => "Scalp Treatment", "duration" => 45, "price" => 45],
                    ]
                ],
            ];
        ?>

        <?php foreach ($servicesData as $section): ?>
            <div class="service-section mb-5">

                <h4 class="mb-3 fs-3 category-title">
                    <?php echo $section['category']; ?>
                </h4>

                <?php foreach ($section["services"] as $service): ?>
                    <div class="services p-4 mb-3 d-flex justify-content-between align-items-center flex-wrap"
                        style="border-radius: 6px;"
                    >
                        <div class="me-3 name">
                            <h5 class="mb-3"><?php echo $service["name"]; ?></h5>

                            <div class="d-flex align-items-center time-price">
                                <span class="me-4"><?php echo $service["duration"]; ?> min</span>
                                <span>£<?php echo $service["price"]; ?>.00</span>
                            </div>
                        </div>

                        <a href="booking.php">
                            <button class="btn btn-primary px-3 py-2">
                                Book This Service
                            </button>
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php endforeach; ?>

    </div>

    <div class="info-section container mb-5">
        <h2>Additional Information</h2>
        <ul>
            <li>All services include consultation</li>
            <li>Prices may vary based on hair length and thickness</li>
            <li>24-hour cancellation notice required</li>
            <li>We use only premium professional products</li>
        </ul>
    </div>

    <?php include("html/footer.html"); ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>