<?php
require_once '../../config/bootstrap.php';
do_auth();

// Fetch all templates
$templates = DB::query("SELECT * FROM email_templates");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Email Template</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Select an Email Template for Bulk Emails</h2>

    <form action="bulk_email.php" method="GET">
        <div class="mb-3">
            <label for="template_id" class="form-label">Email Template</label>
            <select class="form-select" id="template_id" name="template_id" required>
                <option value="" disabled selected>Choose a template...</option>
                <?php foreach ($templates as $template): ?>
                    <option value="<?= $template['id'] ?>">
                        <?= htmlspecialchars($template['name']) ?> (Subject: <?= htmlspecialchars($template['subject']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Send Bulk Emails</button>
    </form>
</div>
</body>
</html>
