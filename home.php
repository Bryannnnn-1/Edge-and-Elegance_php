<?php
    include("html/header.html")
?>


<link rel="stylesheet" href="css/home.css">

<section class="hero d-flex align-items-center text-center text-light">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
        <h1 class="display-4 fw-bold mb-3">Edge and Elegance</h1>
        <p class="lead mb-4">
            Experience luxury hair styling, colouring, and treatments.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="booking.php" class="btn btn-primary px-4 py-2 rounded-pill book-btn">
            Book Appointment
            </a>
            <a href="services.php" class="btn btn-outline-light px-4 py-2 rounded-pill explore-btn">
            View Services
            </a>
            
        </div>
        </div>
    </div>
    </div>
</section>

<section id="services">
  <div class="container py-5">
    <h3 class="text-center mb-4">Popular Services</h3>

    <div class="row g-4">

      <div class="col-md-6 col-lg-3">
        <div class="card h-100 text-center p-3 border-2 rounded-4 shadow-sm service-card">
          <img src="assets/service-1.jpg" alt="Haircut" class="card-img-top service-img">

          <div class="card-body">
            <h5 class="fw-bold title">Haircut</h5>
            <p class="small">
              Precision cuts tailored to your face shape and personal style —
              from classic trims to trendy transformations.
            </p>

            <a href="services.php">
              <button class="btn learn-btn mt-auto">Learn More</button>
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card h-100 text-center p-3 border-2 rounded-4 shadow-sm service-card">
          <img src="assets/service-2.jpg" alt="Colour" class="card-img-top service-img">

          <div class="card-body">
            <h5 class="fw-bold title">Colour</h5>
            <p class="small">
              Rich, vibrant Colour crafted with premium formulas to create depth,
              dimension, and long-lasting brilliance.
            </p>

            <a href="services.php">
              <button class="btn learn-btn mt-auto">Learn More</button>
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card h-100 text-center p-3 border-2 rounded-4 shadow-sm service-card">
          <img src="assets/service-4.jpg" alt="Highlights" class="card-img-top service-img">

          <div class="card-body">
            <h5 class="fw-bold title">Highlights</h5>
            <p class="small">
              Soft, sun-kissed highlights or bold contrast lights that add
              dimension and bring your natural tone to life.
            </p>

            <a href="services.php">
              <button class="btn learn-btn mt-auto">Learn More</button>
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card h-100 text-center p-3 border-2 rounded-4 shadow-sm service-card">
          <img src="assets/service-3.jpg" alt="Styling" class="card-img-top service-img">

          <div class="card-body">
            <h5 class="fw-bold title">Styling</h5>
            <p class="small">
              Luxury blowouts, curls, and finishing styles designed to elevate
              your look for any event or special moment.
            </p>

            <a href="services.php">
              <button class="btn learn-btn mt-auto">Learn More</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="hours" class="py-5 opening-hours">
  <div class="container">
    <h3 class="text-center mb-4">Opening Hours</h3>

    <div class="row justify-content-center">
      <div class="col-md-6">

        <div class="hours-glass card p-4">
          <ul class="list-group list-group-flush hours-list">

            <li class="list-group-item d-flex justify-content-between">
              <span>Monday</span>
              <strong>9:00 AM – 7:00 PM</strong>
            </li>

            <li class="list-group-item d-flex justify-content-between">
              <span>Tuesday</span>
              <strong>9:00 AM – 7:00 PM</strong>
            </li>

            <li class="list-group-item d-flex justify-content-between">
              <span>Wednesday</span>
              <strong>9:00 AM – 7:00 PM</strong>
            </li>

            <li class="list-group-item d-flex justify-content-between">
              <span>Thursday</span>
              <strong>9:00 AM – 8:00 PM</strong>
            </li>

            <li class="list-group-item d-flex justify-content-between">
              <span>Friday</span>
              <strong>9:00 AM – 8:00 PM</strong>
            </li>

            <li class="list-group-item d-flex justify-content-between">
              <span>Saturday</span>
              <strong>9:00 AM – 6:00 PM</strong>
            </li>

            <li class="list-group-item d-flex justify-content-between">
              <span>Sunday</span>
              <strong>10:00 AM – 4:00 PM</strong>
            </li>

          </ul>
        </div>

      </div>
    </div>

  </div>
</section>

<section class="second-hero d-flex align-items-center text-center text-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h1 class="display-4 fw-bold mb-3">Ready to Book Your Appointment?</h1>
        <div class="d-flex justify-content-center gap-3">
          <a href="booking.php" class="btn btn-primary px-4 py-2 rounded-pill book-btn">
            <svg 
            xmlns="http://www.w3.org/2000/svg" 
            height="24px" 
            viewBox="0 -960 960 960" 
            width="24px" 
            fill="black">
                <path d="M200-80q-33 0-56.5-23.5T120-160v-560q0-33 23.5-56.5T200-800h40v-80h80v80h320v-80h80v80h40q33 0 56.5 23.5T840-720v200h-80v-40H200v400h280v80H200Zm0-560h560v-80H200v80Zm0 0v-80 80ZM560-80v-123l221-220q9-9 20-13t22-4q12 0 23 4.5t20 13.5l37 37q8 9 12.5 20t4.5 22q0 11-4 22.5T903-300L683-80H560Zm300-263-37-37 37 37ZM620-140h38l121-122-18-19-19-18-122 121v38Zm141-141-19-18 37 37-18-19Z"/>
                </svg>
            Book Now 
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="testimonial-section py-5">
  <div class="container">

    <div class="text-center mb-5">
      <h2 class="section-title">What Our Clients Say</h2>
    </div>

    <div id="hairSalonTestimonials" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-inner">

        <?php
          $testimonials = [
            [
              "quote" => "The hairstylists here are absolute artists! My haircut was tailored perfectly to my face shape and personality.",
              "name" => "Sophia Martinez",
              "title" => "Regular Client",
              "initials" => "SM"
            ],
            [
              "quote" => "My Colour treatment came out stunning! Rich, vibrant, and exactly the shade I wanted. I felt pampered the entire time.",
              "name" => "Chloe Anderson",
              "title" => "Model & Influencer",
              "initials" => "CA"
            ],
            [
              "quote" => "I booked a styling session for an event and left feeling like a celebrity. The curls lasted all night!",
              "name" => "Emily Carter",
              "title" => "Event Stylist",
              "initials" => "EC"
            ]
          ];

          $isFirst = true;

          foreach ($testimonials as $t):
        ?>

        <div class="carousel-item <?php echo $isFirst ? 'active' : ''; ?>">
          <div class="testimonial-card mx-auto">
            <p class="testimonial-quote">“<?php echo $t['quote']; ?>”</p>

            <div class="testimonial-author d-flex justify-content-center align-items-center">
              <div>
                <h5 class="author-name"><?php echo $t['name']; ?></h5>
                <p class="author-role"><?php echo $t['title']; ?></p>
              </div>
            </div>
          </div>
        </div>

        <?php
          $isFirst = false;
          endforeach;
        ?>

      </div>

    </div>
  </div>
</section>






<?php
    include("html/footer.html")
?>



