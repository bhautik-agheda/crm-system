<?php
require_once '../../config/bootstrap.php';
do_auth();
use Fpdf\Fpdf;

class PDF extends Fpdf
{
    // Page header
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Customer Report', 0, 1, 'C');
        $this->Ln(10);
    }

    // Page footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // Table header
    function CustomerTableHeader()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(200, 200, 200); // Gray background for the header
        $this->Cell(10, 10, 'ID', 1, 0, 'C', true);
        $this->Cell(50, 10, 'Name', 1, 0, 'C', true);
        $this->Cell(50, 10, 'Email', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Phone', 1, 0, 'C', true);
        $this->Cell(50, 10, 'Address', 1, 0, 'C', true);
        $this->Ln();
    }

    // Table rows
    function CustomerTableRow($id, $name, $email, $phone, $address)
    {
        $this->SetFont('Arial', '', 10);
        $this->Cell(10, 10, $id, 1);
        $this->Cell(50, 10, $name, 1);
        $this->Cell(50, 10, $email, 1);
        $this->Cell(30, 10, $phone, 1);
        $this->Cell(50, 10, $address, 1);
        $this->Ln();
    }
}

// Fetch customers from database
$search = isset($_GET['search']) ? $_GET['search'] : '';
$customers = DB::query("SELECT id, name, email, phone, address FROM customers WHERE name LIKE %s", "%$search%");

if (empty($customers)) {
    _redirect(BASE_URL_PUBLIC . 'customers', 'No customer data available.');
}

// Create PDF instance
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Add table header
$pdf->CustomerTableHeader();

// Add customer data
foreach ($customers as $customer) {
    $pdf->CustomerTableRow(
        $customer['id'],
        $customer['name'],
        $customer['email'],
        $customer['phone'],
        $customer['address']
    );

    // Check page overflow
    if ($pdf->GetY() > 260) {
        $pdf->AddPage();
        $pdf->CustomerTableHeader(); // Add header on new page
    }
}

// Output PDF
$pdf->Output('D', 'customer_report.pdf');
