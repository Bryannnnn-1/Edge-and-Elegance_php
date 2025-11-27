<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment - Edge and Elegance</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/booking.css">
    <link rel="stylesheet" href="app.css">
</head>

<body>

<header>
    <?php include("html/header.html"); ?>
</header>

<section class="booking-hero text-center text-light">
    <div class="container">
        <h1 class="fw-bold mb-3">Book Your Appointment</h1>
        <h4>Select your service, date and time</h4>
    </div>
</section>

<div class="container mt-5">
    <form action="" method="POST">
        <div class="row g-4">

            <div class="col-md-6">
                <h3>Appointment Details</h3>

                <div class="mb-3">
                    <label class="form-label">Select Service</label>
                    <select class="form-select" name="service" required>
                        <option value="">Choose a service...</option>
                        <option>Haircut</option>
                        <option>Coloring</option>
                        <option>Styling</option>
                        <option>Treatment</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Select Date</label>
                    <input type="date" class="form-control" name="date" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Select Time</label>
                    <div class="d-flex flex-wrap gap-2">
                        <?php
                        $times = [
                            '09:00 AM','09:30 AM','10:00 AM','10:30 AM','11:00 AM','11:30 AM',
                            '12:00 PM','12:30 PM','01:00 PM','01:30 PM','02:00 PM','02:30 PM',
                            '03:00 PM','03:30 PM','04:00 PM','04:30 PM','05:00 PM','05:30 PM'
                        ];

                        foreach ($times as $t) {
                            echo "<button type='button' class='btn-time' onclick='selectTime(this)'>$t</button>";
                        }
                        ?>
                        <input type="hidden" name="time" id="selectedTime" required>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-section summary mb-3 p-3">
                    <h2>Booking Summary</h2>
                    <p>Service: <span id="summaryService">*****</span></p>
                    <p>Date: <span id="summaryDate">*****</span></p>
                    <p>Time: <span id="summaryTime">*****</span></p>
                </div>

                <input type="submit" class="btn btn-primary w-100" value="Submit Booking" name="book">

                <div class="mt-4 info-section p-3">
                    <h2>Booking Policy</h2>
                    <ul>
                        <li>All services include consultation</li>
                        <li>Prices may vary based on hair length and thickness</li>
                        <li>24-hour cancellation notice required</li>
                        <li>We use only premium, professional products</li>
                    </ul>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
    function selectTime(btn) {
        document.querySelectorAll('.btn-time').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        document.getElementById('selectedTime').value = btn.textContent;
        document.getElementById('summaryTime').textContent = btn.textContent;
    }

    document.querySelector("select[name='service']").addEventListener("change", e => {
        document.getElementById("summaryService").textContent = e.target.value;
    });

    document.querySelector("input[name='date']").addEventListener("change", e => {
        document.getElementById("summaryDate").textContent = e.target.value;
    });
</script>


<footer>
    <?php include("html/footer.html"); ?>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
