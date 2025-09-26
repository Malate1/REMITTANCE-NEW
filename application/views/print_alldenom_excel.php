<?php

$title = 'Collection Summary';
$filename = $this->session->userdata('location') . ' - ' . $title . ' Report - ' . $result . '-' . $dateto . '.csv';

header("Cache-Control: public");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: text/csv; charset=utf-8");

// Open the output stream
$output = fopen('php://output', 'w');

// Write the report title and date range
fputcsv($output, [$this->session->userdata('location') . " - " . $title . ' Report']);
fputcsv($output, [date('F d, Y', strtotime($result)) . " - " . date('F d, Y', strtotime($dateto))]);
fputcsv($output, []); // Blank line

// Write the headers
$headers = [
    'Salesman', 'SRR No.', '1000', '500', '200', '100', '50', '20',
    'Total Bills', 'PDC', 'DC', 'Coins', 'Grand Total'
];
fputcsv($output, $headers);

$prevBu = null;
$sum_totals = [];

foreach ($result1 as $row) {
    if ($row->bu == 'CVS') {
        $row->bu = 'XTRUCK-NETMAN';
    } elseif ($row->bu == '3PS') {
        $row->bu = 'XTRUCK';
    }

    if (!isset($sum_totals[$row->bu])) {
        $sum_totals[$row->bu] = [
            'qty_1000' => 0, 'qty_500' => 0, 'qty_200' => 0, 
            'qty_100' => 0, 'qty_50' => 0, 'qty_20' => 0, 
            'total_bill' => 0, 'total_pdc' => 0, 
            'total_dc' => 0, 'total_coins' => 0, 
            'total_collection' => 0
        ];
    }

    $sum_totals[$row->bu]['qty_1000'] += $row->qty_1000;
    $sum_totals[$row->bu]['qty_500'] += $row->qty_500;
    $sum_totals[$row->bu]['qty_200'] += $row->qty_200;
    $sum_totals[$row->bu]['qty_100'] += $row->qty_100;
    $sum_totals[$row->bu]['qty_50'] += $row->qty_50;
    $sum_totals[$row->bu]['qty_20'] += $row->qty_20;
    $sum_totals[$row->bu]['total_bill'] += $row->total_bill;
    $sum_totals[$row->bu]['total_pdc'] += $row->total_pdc;
    $sum_totals[$row->bu]['total_dc'] += $row->total_dc;
    $sum_totals[$row->bu]['total_coins'] += $row->total_coins;
    $sum_totals[$row->bu]['total_collection'] += $row->total_collection + $row->total_palawan;

    if ($row->bu !== $prevBu) {
        if ($prevBu !== null) {
            // Write the subtotal for the previous BU
            fputcsv($output, array_merge(
                ["Subtotal for $prevBu", '', $sum_totals[$prevBu]['qty_1000'], $sum_totals[$prevBu]['qty_500'], $sum_totals[$prevBu]['qty_200'], 
                $sum_totals[$prevBu]['qty_100'], $sum_totals[$prevBu]['qty_50'], $sum_totals[$prevBu]['qty_20'], 
                number_format($sum_totals[$prevBu]['total_bill'], 2), number_format($sum_totals[$prevBu]['total_pdc'], 2), 
                number_format($sum_totals[$prevBu]['total_dc'], 2), number_format($sum_totals[$prevBu]['total_coins'], 2), 
                number_format($sum_totals[$prevBu]['total_collection'], 2)]
            ));
        }

        // Write the BU header
        fputcsv($output, ["$row->bu"]);
        $prevBu = $row->bu;
    }

    // Write the row data
    fputcsv($output, [
        $row->last_name, $row->manualsrr, $row->qty_1000, $row->qty_500, $row->qty_200,
        $row->qty_100, $row->qty_50, $row->qty_20,
        number_format($row->total_bill, 2), number_format($row->total_pdc, 2),
        number_format($row->total_dc, 2), number_format($row->total_coins, 2),
        number_format($row->total_collection, 2)
    ]);
}

// Write the last BU subtotal
if ($prevBu !== null) {
    fputcsv($output, array_merge(
        ["Subtotal for $prevBu", '', $sum_totals[$prevBu]['qty_1000'], $sum_totals[$prevBu]['qty_500'], $sum_totals[$prevBu]['qty_200'], 
        $sum_totals[$prevBu]['qty_100'], $sum_totals[$prevBu]['qty_50'], $sum_totals[$prevBu]['qty_20'], 
        number_format($sum_totals[$prevBu]['total_bill'], 2), number_format($sum_totals[$prevBu]['total_pdc'], 2), 
        number_format($sum_totals[$prevBu]['total_dc'], 2), number_format($sum_totals[$prevBu]['total_coins'], 2), 
        number_format($sum_totals[$prevBu]['total_collection'], 2)]
    ));
}

// Write the grand total
fputcsv($output, []);
fputcsv($output, [
    'Grand Total', '', $result2->qty_1000, $result2->qty_500, $result2->qty_200,
    $result2->qty_100, $result2->qty_50, $result2->qty_20,
    number_format($result2->total_bill, 2), number_format($result2->total_pdc, 2),
    number_format($result2->total_dc, 2), number_format($result2->total_coins, 2),
    number_format($result2->total_collection, 2)
]);

// Close the output stream
fclose($output);
exit;
?>