<?php
session_start();
require_once '../control/GeneralUserController.php';

include '../includes/header.php';
include '../includes/navbar_general.php'; 
?>
<main>
    <?php if (isset($_SESSION['registration_success'])): ?>
        <div class="alert alert-success" id="success-message">
            Registration successful! Welcome to our community!
        </div>
        <script>
            setTimeout(function() {
                var message = document.getElementById('success-message');
                if (message) {
                    message.style.display = 'none';
                }
            }, 5000); // Hides after 5 seconds
        </script>
        <?php unset($_SESSION['registration_success']); ?>
    <?php endif; ?>

    <section id="home" class="text-center py-5">
        <div class="container">
            <h1 class="display-4 mb-0">Welcome, <?= htmlspecialchars($_SESSION['user_full_name']); ?>!</h1>
            <p class="lead">Thank you for being a part of our community. Your actions help save lives.</p>
        </div>
    </section>

    <section class="container my-5">
        <div class="row text-center g-4">
            
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100 p-4">
                    <h3>See an Animal in Need?</h3>
                    <p>If you've found an injured or distressed animal, you can report it instantly. Our volunteer network is ready to respond.</p>
                    <button class="btn btn-primary btn-lg mt-auto" data-bs-toggle="modal" data-bs-target="#reportCaseModal">
                        Report a Case
                    </button>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100 p-4">
                    <h3>Looking for a Forever Friend?</h3>
                    <p>Browse through profiles of our rescued animals who are looking for a loving home. Your new best friend might be waiting.</p>
                    <a href="#" class="btn btn-primary btn-lg mt-auto">View Adoptable Animals</a>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100 p-4">
                    <h3>Support Our Mission</h3>
                    <p>Your contributions save lives! Donate to specific rescue cases or our general fund to provide food, medicine, and care.</p>
                    <a href="#" class="btn btn-primary btn-lg mt-auto">Make a Donation</a>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100 p-4">
                    <h3>Educational Resources</h3>
                    <p>Access our library of animal care videos and guides, or contact our emergency hotline for immediate assistance.</p>
                    <a href="#" class="btn btn-primary btn-lg mt-auto">View Resources</a>
                </div>
            </div>

        </div>
    </section>
</main>

<div class="modal fade" id="reportCaseModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Report an Animal in Need</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="report-mission-form" action="../control/CreateMissionController.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="location" class="form-label">Location of the Animal</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="e.g., Near Mirpur 10 roundabout" required>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Upload a Photo/Video</label>
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*,video/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Brief Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="e.g., Small brown dog, has an injured paw." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit Report</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
include '../../Main/includes/footer.php'; 
?>