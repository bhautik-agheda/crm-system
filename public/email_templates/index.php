<?php
require_once '../../config/bootstrap.php';
do_auth();
$page_title = 'Email template';
include BASE_PATH . 'templates/header.php';
?>
<div class="body-section">

    <!-- Add New Template Button -->
    <a href="manage.php" class="btn btn-primary mb-3">Add New Template</a>

    <!-- Templates Table -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $templates = DB::query("SELECT * FROM email_templates ORDER BY created_at DESC");
                foreach ($templates as $template):
                    ?>
                    <tr>
                        <td><?= $template['id'] ?></td>
                        <td><?= htmlspecialchars($template['name']) ?></td>
                        <td><?= htmlspecialchars($template['subject']) ?></td>
                        <td><?= $template['created_at'] ?></td>
                        <td>
                            <a href="manage.php?id=<?= $template['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?id=<?= $template['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this template?')">Delete</a>
                            <a href="bulk_email.php?template_id=<?= $template['id'] ?>" class="btn btn-primary btn-sm">Bulk email</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include BASE_PATH . 'templates/footer.php'; ?>