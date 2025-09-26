<main>
    
    <div class="container-fluid">
        <h4 class="mt-4">Manager's Key</h4>
        
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Manager's Key Logs
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover compact" id="dataTableLogs" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>SRR</th>
                                <th>Salesman</th>
                                <th>Variance</th>
                                <th>Remarks</th>
                                <th>Processed by</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $row) { 
                                $total = $row->total_collection + $row->sm_inc;
                                ?>
                            <tr>
                                <td><?php echo $row->date_added; ?></td>
                                <td><?php echo $row->denom_id; ?></td>
                                <td><?php echo $row->full_name; ?></td>
                                <td><?php echo $total - $row->total_remittance; ?></td>
                                <td><?php echo $row->remarks; ?></td>
                                <td><?php echo $row->manager_key; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

