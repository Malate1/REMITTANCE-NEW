<?php
$title = 'Collection Summary';
$filename = $this->session->userdata('location') . ' - ' . $title . ' Report - ' . $result3->bu_desc . '-' . $dateto . '.csv';

header("Cache-Control: public");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: text/csv; charset=utf-8");

// Open the output stream
$output = fopen('php://output', 'w');

// Report Header
fputcsv($output, [$this->session->userdata('location') . " - " . $title . ' Report']);
fputcsv($output, ["DATE: " . date('F d, Y', strtotime($datefrom)) . " - " . date('F d, Y', strtotime($dateto))]);
fputcsv($output, []); // Blank line

// If salesman is specified
if ($sm != 'All') {
    fputcsv($output, ['Salesman:', strtoupper(@$full_name->full_name)]);
    fputcsv($output, []); // Blank line
}

// Column Headers
$headers = ($sm != 'All') 
    ? ['Date', 'SRR No.', 'Cash', 'PDC', 'DC', 'Remittance', 'Accountability', 'Variance', 'Remarks']
    : ['Salesman', 'SRR No.', 'Cash', 'PDC', 'DC', 'Remittance', 'Accountability', 'Variance', 'Remarks'];

fputcsv($output, $headers);

// Initialize total
$overall_total = 0.00;

// Loop through data
foreach ($result1 as $row) {
    // Determine displayed name
    $sm_name = ($row->remarks == "") ? $row->last_name : $row->last_name;

    // Totals
    $total = $row->total_collection + $row->sm_inc;
    $remittance_total = $row->total_remittance + $row->total_palawan;
    $overall_total += $remittance_total;

    // Build the row
    $rowData = [
        ($sm != 'All') ? date("F d, Y", strtotime($row->date_added)) : $sm_name,
        $row->manualsrr,
        number_format($row->total_cash, 2),
        number_format($row->total_pdc, 2),
        number_format($row->total_dc, 2),
        number_format($row->total_collection + $row->total_palawan, 2),
        number_format($remittance_total, 2),
        number_format($total - $row->total_remittance, 2),
        $row->remarks
    ];

    fputcsv($output, $rowData);
}

// Grand Total
fputcsv($output, []); // Blank line
fputcsv($output, ['', '', '', '', '', 'Grand Total:', number_format($overall_total, 2)]);
fclose($output);
exit;
?>
