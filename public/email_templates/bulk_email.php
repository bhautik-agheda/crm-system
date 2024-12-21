<?php

require_once '../../config/bootstrap.php';
do_auth();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Validate and fetch the `template_id`
if (!isset($_GET['template_id']) || !is_numeric($_GET['template_id'])) {
    _redirect(BASE_URL_PUBLIC . 'email_templates', 'Please go back and select a valid template.');
}

$templateId = $_GET['template_id'];

// Fetch the email template
$template = DB::queryFirstRow("SELECT * FROM email_templates WHERE id = %i", $templateId);
if (!$template) {
    _redirect(BASE_URL_PUBLIC . 'email_templates', 'Template not found. Please check your selection.');
}

// Fetch all customers
$customers = DB::query("SELECT * FROM customers");
if (empty($customers)) {
    _redirect(BASE_URL_PUBLIC . 'email_templates', 'No customers found.');
}

// Configure PHPMailer
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USERNAME; // Your Gmail
    $mail->Password = SMTP_PASSWORD;   // Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    foreach ($customers as $customer) {
        // Personalize the email body
        $personalizedBody = str_replace('{{name}}', $customer['name'], $template['body']);

        $mail->setFrom('bhautik.agheda@gmail.com', 'Bhautik Agheda');
        $mail->addAddress($customer['email']);
        $mail->Subject = $template['subject'];
        $mail->Body = $personalizedBody;

        try {
            $mail->send();
            $status = 'sent';
            $errorMessage = null;
        } catch (Exception $e) {
            $status = 'failed';
            $errorMessage = $mail->ErrorInfo;
        }

        // Log the email status
        DB::insert('email_logs', [
            'customer_id' => $customer['id'],
            'email_template_id' => $template['id'],
            'email' => $customer['email'],
            'subject' => $template['subject'],
            'message' => $personalizedBody,
            'status' => $status,
            'error_message' => $errorMessage
        ]);

        $mail->clearAddresses(); // Clear recipient for next loop
    }

    _redirect(BASE_URL_PUBLIC . 'email_templates', 'Bulk emails sent successfully! <a href="'.BASE_URL_PUBLIC.'email_logs" class="alert-link">Email Logs</a>', 'success');
} catch (Exception $e) {
    _redirect(BASE_URL_PUBLIC . 'email_templates', "Mailer Error: {$mail->ErrorInfo}");
}
?>
