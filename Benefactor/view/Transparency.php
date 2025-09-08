<?php
// This view is now loaded by TransparencyController.php
include '../includes/navbar.php'; 
?>

<main>
<section id="transparency">
  <div class="container py-4">
    <div class="text-center mb-5">
      <h2>Financial Transparency</h2>
      <p class="lead">We value your trust. Here's a detailed breakdown of how community funds are making a difference.</p>
    </div>

    <div class="row text-center mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Donations Received</h5>
                    <p class="card-text fs-2 fw-bold text-success">$<?= number_format($summary['total_received'], 2); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Funds Utilized</h5>
                    <p class="card-text fs-2 fw-bold text-danger">$<?= number_format($summary['total_used'], 2); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Animals Directly Sponsored</h5>
                    <p class="card-text fs-2 fw-bold text-primary"><?= $summary['animals_helped']; ?></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="my-5">
        <h3>Detailed Expense Log</h3>
        <p>A complete record of every fund utilization, managed by our dedicated volunteers.</p>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Date</th>
                    <th>Purpose of Expense</th>
                    <th>Managed By</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fundLog as $log): ?>
                <tr>
                    <td><?= date('M j, Y', strtotime($log['DateUsed'])); ?></td>
                    <td><?= htmlspecialchars($log['Purpose']); ?></td>
                    <td><?= htmlspecialchars($log['VolunteerName']); ?></td>
                    <td>$<?= number_format($log['AmountUsed'], 2); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="my-5">
        <h3>Campaign Financial Status</h3>
        <p>An overview of the fundraising goals and progress for all our campaigns.</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Campaign Name</th>
                    <th class="text-end">Goal</th>
                    <th class="text-end">Raised</th>
                    <th style="width: 25%;">Progress</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($campaigns as $campaign): ?>
                <?php $progress = ($campaign['GoalAmount'] > 0) ? ($campaign['RaisedAmount'] / $campaign['GoalAmount']) * 100 : 0; ?>
                <tr>
                    <td><?= htmlspecialchars($campaign['CampaignName']); ?></td>
                    <td class="text-end">$<?= number_format($campaign['GoalAmount']); ?></td>
                    <td class="text-end">$<?= number_format($campaign['RaisedAmount']); ?></td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?= round($progress); ?>%;"><?= round($progress); ?>%</div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
  </div>
</section>
</main>

<?php include '../includes/footer.php'; ?>