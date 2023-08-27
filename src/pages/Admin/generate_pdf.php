<?php
require('../../fpdf/fpdf.php'); // Make sure to provide the correct path to the fpdf library

if (!isset($_GET['sessionID'])) {
    // Handle the case when sessionID is not provided
    die("Session ID not provided.");
}

$session_id = $_GET['sessionID'];

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'Session Information', 0, 1, 'C');
        $this->Ln(10); // Add some space after the header
    }

    function Footer()
    {
        // Add a page border
        $this->SetDrawColor(0, 0, 0); // Black color for the border
        $this->Rect(5, 5, 200, 280); // Set the position and dimensions of the border rectangle

        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();

try {
    $connection = new mysqli("localhost", "root", "", "attendance_system");
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    
    $query = "SELECT * FROM session WHERE sessionID = $session_id";
    $query2 = "SELECT regNum FROM attendance WHERE sessionID = $session_id";

    $result_set = $connection->query($query);
    $result_set2 = $connection->query($query2);

    while ($row = $result_set->fetch_assoc()) {
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "Session ID: " . $row["sessionID"], 0, 1);
        $pdf->Cell(0, 10, "Faculty: " . $row["faculty"], 0, 1);
        $pdf->Cell(0, 10, "Subject: " . $row["subject"], 0, 1);
        $pdf->Cell(0, 10, "Date: " . $row["date"], 0, 1);
        $pdf->Cell(0, 10, "Start Time: " . $row["timeStart"], 0, 1);
        $pdf->Cell(0, 10, "End Time: " . $row["timeEnd"], 0, 1);
        $pdf->Ln(10); // Add some space between session details and attendance IDs
    }
    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, "Attendance IDs:", 0, 1);
    $pdf->SetFont('Arial', '', 12);
    while ($row2 = $result_set2->fetch_assoc()) {
        $pdf->Cell(0, 10, "Attendance ID: " . $row2["regNum"], 0, 1);
    }

    $connection->close();
} catch (mysqli_sql_exception $e) {
    // Handle the exception
    die("Error: " . $e->getMessage());
}

$pdf->Output('D', 'session_information.pdf'); // D: Download, F: Save to file, I: Display in browser
?>
