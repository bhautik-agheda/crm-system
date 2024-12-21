<?php
require_once '../../config/bootstrap.php';
do_auth();

$template = [
    'id' => null,
    'name' => '',
    'subject' => '',
    'body' => ''
];

// Fetch template if `id` is set
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $template = DB::queryFirstRow("SELECT * FROM email_templates WHERE id = %i", $_GET['id']);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    if ($template['id']) {
        // Update existing template
        DB::update('email_templates', [
            'name' => $name,
            'subject' => $subject,
            'body' => $body
                ], "id = %i", $template['id']);
        
        _redirect(BASE_URL_PUBLIC . 'email_templates', 'Email templates update successfully', 'success');
        
    } else {
        // Insert new template
        DB::insert('email_templates', [
            'name' => $name,
            'subject' => $subject,
            'body' => $body
        ]);
        _redirect(BASE_URL_PUBLIC . 'email_templates', 'Email templates added successfully', 'success');
    }
}
$page_title = $template['id'] ? 'Edit Template' : 'Add New Template';
include BASE_PATH . 'templates/header.php';
?>

<div class="body-section">

    <!-- Form -->
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Template Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($template['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label">Email Subject</label>
            <input type="text" class="form-control" id="subject" name="subject" value="<?= htmlspecialchars($template['subject']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Email Body</label>
            <textarea class="form-control" id="body" name="body" rows="6" required><?= htmlspecialchars($template['body']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php include BASE_PATH . 'templates/footer.php'; ?>