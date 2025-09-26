<main>

    <link href="<?php echo base_url(); ?>assets/css/dataTables.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css" rel="stylesheet"
        crossorigin="anonymous" />

    <style>
    @media print {
        table td:last-child {
            display: none
        }

        table th:last-child {
            display: none
        }
    }
    </style>

    <div class="container-fluid">
        <h4 class="mt-4">Extruck Salesman Payments</h4>
        <a onclick=backpage()>
            <button class="btn btn-primary">
                <i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Go Back
            </button></a><br /><br />
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                <?php if (!empty($row->full_name) && !empty($result2)): ?>
                Payments of salesman - <b style="font-size: 20px"><?php echo $row->full_name; ?></b>
                from <b style="font-size: 20px"><?php echo date("F d, Y", strtotime($result2)); ?></b> to <b
                    style="font-size: 20px"><?php echo date("F d, Y", strtotime($result3)); ?></b>
                <?php endif; ?>
                <input type="hidden" id="salesman_name" value="<?php echo @$row->full_name; ?>">

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table sm_checks compact" id="dataTableOP" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center">
                                <th>Payment Date</th>
                                <th>SI No.</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Pay Amount</th>
                                
                                
                                <th>Denom</th>
                            </tr>
                        </thead>
                        <tbody>

                            
                            <?php 
                                
                                $grouped_data = [];
                                $grand_total_net = 0;
                                
                                // Group data by pay_date
                                foreach ($result as $row) {
                                    $grouped_data[$row['pay_date']][] = $row;
                                }

                                foreach ($grouped_data as $pay_date => &$rows) {
                                    usort($rows, function ($a, $b) {
                                        return strcmp($a['si_docno'], $b['si_docno']);
                                    });
                                }
                                unset($rows); 
                                
                                
                                foreach ($grouped_data as $pay_date => $rows) {
                                    $sub_total_net = 0; 
                                    foreach ($rows as $row2) {
                                        $sub_total_net += $row2['pay_amount'];
                                        $grand_total_net += $row2['pay_amount'];
                                    ?>
                                    <tr>
                                        <td><?php echo $row2['pay_date']; ?></td>
                                        <td><?php echo $row2['si_docno']; ?></td>
                                        <td><?php echo $row2['cus_code']; ?></td>
                                        <td><?php echo $row2['name']; ?></td>
                                        <td><?php echo number_format($row2['pay_amount'], 2); ?></td>
                                        <td><?php echo $row2['denom_id']; ?></td>
                                    </tr>
                                    <?php } ?>

                            <!-- <tr class="group-row" align="center">
                                        <td colspan="10"><strong>Subtotal</strong></td>
                                        <td><strong><?php echo number_format($sub_total_net, 2); ?></strong></td>
                                        
                                    </tr> -->
                            <?php } 
                            ?>
                        </tbody>
                        <tfoot>

                            <tr >

                                <td colspan="5"><strong>Gross Amount</strong></td>
                                <td><strong><?php echo number_format(@$grand_total_net, 2); ?></strong>
                                </td>
                            </tr>
                            

                            <tr>
                                <td colspan="5"><strong> Total Palawan Amount</strong></td>
                                <td><strong><?php echo number_format(@$palawan->total_pay_amount, 2); ?></strong></td>


                            </tr>



                            

                            <tr>
                                <td colspan="5"><strong>Net Amount</strong></td>
                                <td>
                                    <strong>
                                        <?php
                                            $grandTotalNet   = isset($grand_total_net) ? $grand_total_net : 0;
                                            
                                            $palawanAmount   = isset($palawan->total_pay_amount) ? $palawan->total_pay_amount : 0;
                                            
                                            //$boAmount        = isset($incentives->total_bo_amount) ? $incentives->total_bo_amount : 0;

                                            $netAmount = $grandTotalNet - $palawanAmount ;

                                            echo number_format($netAmount, 2);
                                        ?>
                                    </strong>
                                </td>
                            </tr>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script src="<?php echo base_url(); ?>assets/js/jquery-3.7.1.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables.buttons.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/buttons.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jszip_new.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pdfmake-0.2.7.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vfs_fonts-0.2.7.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/buttons.html5new.min.js"></script>

    <script>
    $(document).ready(function() {


        var table = $('#dataTableOP').DataTable({
            dom: "<'text-right'B><'row'<'col-md-5 col-12'l><'col-md-7 text-end'f>>r<'table-responsive't><'row'<'col-md-5 col-12'i><'col-md-7 col-12'p>>",
            buttons: [

                {
                    extend: 'pdf',
                    // title: 'Daily Van Sales Remittance Report',
                    footer: true,
                    orientation: 'PORTRAIT',
                    pageSize: 'LETTER',

                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    customize: function(doc) {
                        
                        doc.defaultStyle = {
                            fontSize: 8,          // Set default font size to 8
                            alignment: 'center',  // Center-align all text
                            margin: [0, 2, 0, 2]  // Set margin to 2 (left, top, right, bottom)
                        };

                        // Adjust table data margin
                        if (doc.content && doc.content[1]) {
                            doc.content[1].margin = [0, 2, 0, 2]; // Margin for the table content
                        }

                        // Change table header style
                        if (doc.styles && doc.styles.tableHeader) {
                            doc.styles.tableHeader.fontSize = 9; // Slightly larger than body text
                            doc.styles.tableHeader.alignment = 'center';
                        }

                        // Title formatting
                        if (doc.content && doc.content[0] && doc.content[0].text) {
                            doc.content[0].fontSize = 9;  // Title font size
                            doc.content[0].bold = true;    // Bold title
                            doc.content[0].alignment = 'center';
                            doc.content[0].margin = [0, 2, 0, 2];
                        }

                        var salesmanName = document.getElementById('salesman_name').value;
                        doc['header'] = function() {
                            return {
                                stack: [
                                    {
                                        text: 'Daily Van Sales Remittance Report',
                                        alignment: 'center',
                                        fontSize: 10,
                                        bold: true,
                                        margin: [0, 5, 0, 2]
                                    },
                                    {
                                        text: 'Salesman - ' + salesmanName + 
                                            ' from ' + '<?php echo date("F d, Y", strtotime(@$result2)); ?>' +
                                            ' to ' + '<?php echo date("F d, Y", strtotime(@$result3)); ?>',
                                        alignment: 'center',
                                        fontSize: 9,
                                        margin: [0, 0, 0, 2]
                                    }
                                ]
                            };
                        };

                        // Add grouped date and subtotal rows
                        if (doc.content && Array.isArray(doc.content[1].table.body)) {
                            const body = doc.content[1].table.body;
                            let lastPayDate = null;
                            let subTotalNet = 0;
                            const newBody = [];
                            let isFirstGroup = true;
                            let tfootData = [];

                            // Identify and separate the tfoot data (assuming last 3 rows)
                            if (body.length > 2) {
                                const lastRow = body[body.length - 1];
                                const secondLastRow = body[body.length - 1];

                                if (lastRow[0].text.includes("Net Amount")) {
                                    tfootData = body.splice(-1,
                                    1); // Remove last two rows (tfoot) and store
                                }
                            }

                            // Iterate over table rows
                            body.forEach((row, index) => {
                                const payDate = row[0].text;
                                const netAmount = parseFloat(row[4].text.replace(/,/g,
                                    ''));

                                if (lastPayDate !== payDate) {
                                    // Add previous group's subtotal row (skip for the first group)
                                    if (!isFirstGroup && !isNaN(subTotalNet) &&
                                        subTotalNet > 0) {
                                            newBody.push([
                                            {
                                                text: 'Subtotal:',
                                                colSpan: 5,
                                                alignment: 'right',
                                                bold: true
                                            },
                                            {}, {}, {}, {},
                                            {
                                                text: number_format(subTotalNet, 2),
                                                alignment: 'right',
                                                bold: true
                                            }
                                            ]);


                                    }

                                    // Add group header for the new pay date
                                    newBody.push([
                                    {
                                        text: payDate,
                                        colSpan: 6,
                                        alignment: 'left',
                                        bold: true
                                    },
                                    {}, {}, {}, {}, {}
                                    ]);



                                    subTotalNet = 0; // Reset subtotal
                                    isFirstGroup = false;
                                }

                                newBody.push(row); // Add the actual row

                                if (!isNaN(netAmount)) {
                                    subTotalNet += netAmount;
                                }

                                lastPayDate = payDate;
                            });

                            // Add final subtotal after the last group
                            if (!isNaN(subTotalNet) && subTotalNet > 0) {
                                newBody.push([
                                {
                                    text: 'Subtotal:',
                                    colSpan: 5,
                                    alignment: 'right',
                                    bold: true
                                },
                                {}, {}, {}, {},
                                {
                                    text: number_format(subTotalNet, 2),
                                    alignment: 'right',
                                    bold: true
                                }
                                ]);

                            }

                            // Append back the tfoot data without modifications
                            newBody.push(...tfootData);

                            // Assign the modified body back to the document
                            doc.content[1].table.body = newBody;
                        }




                    }



                },
                {
                    extend: 'csv',
                    title: 'Daily Van Sales Remittance Report',
                    footer: true,
                    customize: function(csv) {
                        var data = csv.split("\n");
                        var groupedData = [];
                        var lastPayDate = "";
                        var subTotalNet = 0;

                        // Identify tfoot (last two rows)
                        var tfootRows = data.slice(-2);
                        var dataRows = data.slice(0, -2); // Exclude last two rows

                        dataRows.forEach((row, index) => {
                            if (index === 0) {
                                groupedData.push(row); // Add the header
                            } else if (row.trim() !== "") {
                                var cells = row.match(/(".*?"|[^",\s]+)(?=\s*,|\s*$)/g);
                                var payDate = cells[0];

                                var netAmountText = cells[4]?.replace(/"/g, "").trim();
                                var netAmount = parseFloat(netAmountText.replace(/,/g,
                                    "")) || 0;

                                if (payDate !== lastPayDate) {
                                    if (lastPayDate) {
                                        // Add subtotal row for the previous group
                                        groupedData.push(
                                            `Subtotal,,,,,,${subTotalNet.toFixed(2)}`
                                            );
                                    }

                                    // Add group row
                                    groupedData.push(`${payDate},,,,,,`);
                                    subTotalNet = 0; // Reset subtotal
                                }

                                subTotalNet += netAmount; // Accumulate Net Amount
                                groupedData.push(row);
                                lastPayDate = payDate;
                            }
                        });

                        // Append the original tfoot rows without modification
                        groupedData = groupedData.concat(tfootRows);

                        return groupedData.join("\n");
                    }

                },
                


            ],



            pageLength: 1000,
            order: [
                [0, 'asc']
            ], // Ensure rows are ordered by pay_date (first column)
            drawCallback: function(settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var lastPayDate = null; // Variable to track the last pay_date
                var subTotalNet = 0; // Variable to accumulate the subtotal for the current group

                api.column(0, {
                        page: 'current'
                    }) // Grouping by the first column (pay_date)
                    .data()
                    .each(function(pay_date, i) {
                        var row = $(rows).eq(i); // Get the current row
                        var netAmount = parseFloat(row.find('td').eq(4).text().replace(/,/g,
                            '')); // Get pay_amount from the row (11th column)


                        // If we are on a new pay_date group, add a group row
                        if (lastPayDate !== pay_date) {
                            // If this is not the first group, add the subtotal row for the previous group
                            if (lastPayDate !== null) {
                                $(rows).eq(i - 1).after(
                                    '<tr class="sub-total-row"><td colspan="5"><strong>Subtotal </strong></td><td><strong>' +
                                    number_format(subTotalNet, 2) + '</strong></td></tr>'
                                );
                            }

                            // Reset subtotal for the new group
                            subTotalNet =
                            netAmount; // Start subtotal with the first row of the new group
                            $(rows).eq(i)
                                .before('<tr class="group-row"><td colspan="5"><strong>' +
                                    pay_date + '</strong></td></tr>');
                        } else {
                            // Accumulate the pay_amount for the current pay_date group
                            subTotalNet += netAmount;
                        }

                        lastPayDate = pay_date; // Update the lastPayDate to the current one
                    });

                // After processing all rows, add the subtotal row for the last group
                $(rows).last().after(
                    '<tr class="sub-total-row"><td colspan="5"><strong>Subtotal: </strong></td><td><strong>' +
                    number_format(subTotalNet, 2) + '</strong></td></tr>'
                );
            }
        });
    });

    function createGroupRow(payDate) {
        return `<row><c t="inlineStr" r="A1"><is><t>${payDate}</t></is></c></row>`;
    }

    function createSubtotalRow(subTotal) {
        return `<row><c t="inlineStr" r="A1"><is><t>Subtotal</t></is></c><c r="K1"><v>${subTotal.toFixed(2)}</v></c></row>`;
    }
    console.log($.fn.dataTable.version); // Logs DataTables version
    console.log($.fn.dataTable.Buttons.version); // Logs Buttons extension version
    console.log($('#dataTableOP thead th').length); // number of headers
    console.log($('#dataTableOP tbody tr:first td').length); // number of columns in first row

    // Function to format numbers with commas and two decimal places
    function number_format(number, decimals) {
        return number.toFixed(decimals).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    </script>

    <script>
    function backpage() {
        window.history.back();
    }
    </script>
</main>