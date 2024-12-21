<?php
require_once '../../config/bootstrap.php';
do_auth();
$page_title = 'Download Customer Report';
include BASE_PATH . 'templates/header.php';
?>

<div class="body-section">
    <div class="container mt-5">
        <h2>Download Customer Report</h2>
        <p>Click the button below to generate and download the customer report in PDF format.</p>
        <a href="pdf.php" class="btn btn-primary">Download PDF</a>
    </div>
</div>
<?php include BASE_PATH . 'templates/footer.php'; ?>