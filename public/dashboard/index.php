<?php
require_once '../../config/bootstrap.php';
do_auth();
$page_title = 'Dashboard';
include BASE_PATH . 'templates/header.php';

// Fetch total customers
$totalCustomers = DB::queryFirstField("SELECT COUNT(*) FROM customers");

// Fetch total emails sent
$totalEmailsSent = DB::queryFirstField("SELECT COUNT(*) FROM email_logs WHERE status = %s", 'sent');

// Fetch total emails failed
$totalEmailsFailed = DB::queryFirstField("SELECT COUNT(*) FROM email_logs WHERE status = %s", 'failed');

// Fetch total email templates
$totalEmailTemplates = DB::queryFirstField("SELECT COUNT(*) FROM email_templates");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<div class="body-section">
    <h2 class="mb-4">Welcome to the Dashboard, <?php echo $_SESSION['username']; ?></h2>
    <div class="row">
        <!-- Stats Cards -->
        <div class="col-md-3 mb-3">
            <div class="card stats-card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Customers</h5>
                    <p class="card-text fs-4"><?php echo $totalCustomers; ?></p>
                    <i class="fas fa-users fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stats-card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Emails Sent</h5>
                    <p class="card-text fs-4"><?php echo $totalEmailsSent; ?></p>
                    <i class="fas fa-envelope fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stats-card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title">Emails Failed</h5>
                    <p class="card-text fs-4"><?php echo $totalEmailsFailed; ?></p>
                    <i class="fas fa-envelope fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stats-card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Count Email Templates</h5>
                    <p class="card-text fs-4"><?php echo $totalEmailTemplates; ?></p>
                    <i class="fas fa-tasks fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include BASE_PATH . 'templates/footer.php'; ?>