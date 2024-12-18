<?php
ob_start(); // Start output buffering

require('../../fpdf/fpdf.php'); // Include FPDF library
include '../../controller/signupcontroller.php';

$signupcontroller = new signup();
$signups = $signupcontroller->listesignup();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

// Title
$pdf->Cell(0, 10, 'Liste des Inscrits', 0, 1, 'C');
$pdf->Ln(5);

// Table header
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(230, 230, 230);
$pdf->Cell(10, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Nom', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Prénom', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Date de Naissance', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Email', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Rôle', 1, 1, 'C', true);

// Table content
$pdf->SetFont('Arial', '', 10);
foreach ($signups as $signup) {
    $pdf->Cell(10, 10, htmlspecialchars($signup['id']), 1, 0, 'C');
    $pdf->Cell(30, 10, htmlspecialchars($signup['Nom']), 1, 0, 'C');
    $pdf->Cell(30, 10, htmlspecialchars($signup['Prenom']), 1, 0, 'C');
    $pdf->Cell(30, 10, htmlspecialchars($signup['date']), 1, 0, 'C');
    $pdf->Cell(50, 10, htmlspecialchars($signup['Email']), 1, 0, 'C');
    $pdf->Cell(30, 10, htmlspecialchars($signup['role']), 1, 1, 'C');
}

ob_end_clean(); // Clean (erase) the output buffer
$pdf->Output('D', 'liste_inscrits.pdf'); // 'D' forces the download of the PDF
exit;
