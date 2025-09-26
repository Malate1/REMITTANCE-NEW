<?php
    if ($result2 == 'BOTH') {
        $title = 'PDC & DC';
    } else {
        $title = $result2;
    }

    $filename = $this->session->userdata('location') . ' - ' . $title . ' Report - ' . $result3 . '-' . $result . '.csv';

    header("Cache-Control: public");
    header("Content-Type: text/csv; charset=utf-8");
    header("Content-Disposition: attachment; filename=$filename");

    // Open output stream
    $output = fopen('php://output', 'w');

    // Write the header row
    fputcsv($output, [
        'Collect Date',
        'Check Date',
        'No. of Days',
        'Type',
        'Salesman',
        'Account Name',
        'Account No.',
        'Customer Name',
        'Bank',
        'Check No.',
        'Amount'
    ]);

    $total = 0;

    // Write data rows
    foreach ($result1 as $row) {
        $total += $row->amount;
        fputcsv($output, [
            $row->pay_date,
            $row->due_date,
            $row->nodays,
            $row->type,
            $row->full_name,
            $row->acc_name,
            $row->acc_num,
            $row->name,
            $row->bank,
            "'" . $row->check_no, // Add an apostrophe
            number_format($row->amount, 2)
        ]);
    }

    // Add OPLAN section
    fputcsv($output, ['OPLAN']);
    foreach ($result4 as $row) {
        $type = ($row->check_type == 'Post Dated Check') ? 'PDC' : 'DC';
        $total += $row->pay_amount;
        fputcsv($output, [
            $row->pay_date,
            $row->due_date,
            $row->nodays,
            $type,
            $row->full_name,
            $row->acc_name,
            $row->acc_no,
            $row->name,
            $row->check_bank,
            "'" . $row->check_no, // Add an apostrophe
            number_format($row->pay_amount, 2)
        ]);
    }

    // Add XTRUCK section
    fputcsv($output, ['XTRUCK']);
    foreach ($result5 as $row) {
        $type = ($row->check_type == 'Post Dated Check') ? 'PDC' : 'DC';
        $total += $row->pay_amount;
        fputcsv($output, [
            $row->pay_date,
            $row->due_date,
            $row->nodays,
            $type,
            $row->full_name,
            $row->acc_name,
            $row->acc_no,
            $row->name,
            $row->check_bank,
            "'" . $row->check_no, // Add an apostrophe
            number_format($row->pay_amount, 2)
        ]);
    }

    if ($total == 0) {
        fputcsv($output, ['No data available in table']);
    }

    // Add total row
    fputcsv($output, ['Total', '', '', '', '', '', '', '', '', '', number_format($total, 2)]);

    // Close output stream
    fclose($output);
?>
