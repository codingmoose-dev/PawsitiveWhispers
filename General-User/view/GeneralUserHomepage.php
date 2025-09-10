<?php
session_start();
require_once '../control/GeneralUserController.php';

include '../includes/header.php';
include '../includes/navbar_general.php'; 
?>

<main>
    <section id="home" class="text-center py-5">
        <div class="container">
            <h1 class="display-4">Welcome, <?= htmlspecialchars($_SESSION['user_full_name']); ?>!</h1>
            <p class="lead">Thank you for being a part of our community. Your actions help save lives.</p>
        </div>
    </section>

    <section class="container my-5">
        <div class="row text-center g-4">
            
            <div class="col-md-6">
                <div class="card shadow-sm h-100 p-4">
                    <h3>See an Animal in Need?</h3>
                    <p>If you've found an injured or distressed animal, you can report it instantly. Our volunteer network is ready to respond.</p>
                    <button class="btn btn-primary btn-lg mt-auto" data-bs-toggle="modal" data-bs-target="#reportCaseModal">
                        Report a Case
                    </button>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm h-100 p-4">
                    <h3>Looking for a Forever Friend?</h3>
                    <p>Browse through profiles of our rescued animals who are looking for a loving home. Your new best friend might be waiting.</p>
                    <a href="#" class="btn btn-secondary btn-lg mt-auto">View Adoptable Animals</a>
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
                        <div class="form-text">A clear image helps our AI and volunteers assess the situation quickly.</div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Brief Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="e.g., Small brown dog, seems to have an injured front paw." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit Report</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>