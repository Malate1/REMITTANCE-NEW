<main>
    <div class="container-fluid">
        <h2 class="mt-4">Dashboard</h2>
        <div class="row">
            <div class="col-xl-4 col-md-6"> 
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Salesman Remittance Today</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link">Remittances</a>
                        <div class="small text-white">
                            <span class="badge badge-danger" style="font-size:11px">
                                <?= $remittance_count ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6"> 
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Total <?= $location ?> Denominations (All Time)</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link">Total Records</a>
                        <div class="small text-white">
                            <span class="badge badge-light" style="font-size:11px">
                                <?= $total_denom_count ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <h2>Top Salesmen by Total Remittance</h2>

            <form method="get" action="<?= base_url('main') ?>" class="mb-4">
                <div class="row g-3 align-items-end">
                    <!-- Start Date -->
                    <div class="col-md-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" name="start_date" id="start_date" value="<?= $start_date ?>" class="form-control" required>
                    </div>

                    <!-- End Date -->
                    <div class="col-md-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" name="end_date" id="end_date" value="<?= @$end_date ?>" class="form-control" required>
                    </div>

                    <!-- BU Dropdown -->
                    <div class="col-md-3">
                        <label for="bu" class="form-label">Business Unit (BU)</label>
                        <select name="bu" id="bu" class="form-control form-select">
                            <option value="">All BU</option>
                            <?php foreach ($bu_list as $b): ?>
                                <option value="<?= $b->bu ?>" <?= ($selected_bu == $b->bu ? 'selected' : '') ?>>
                                    <?= $b->bu ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-3 d-grid">
                        <button type="submit" class="btn btn-primary">Filter</button>
                       

                    </div>
                </div>
            </form>

            <?php if (count($salesmen) > 0): ?>
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Top Salesmen by Remittance</h5>
                    </div>
                    <div class="card-body">
                        <div style="height: 600px; overflow-x: auto;">
                            <canvas id="topSalesmenChart"></canvas>
                        </div>
                    </div>
                </div>

                <script>
                    var ctx = document.getElementById("topSalesmenChart").getContext("2d");

                    var data = {
                        labels: [
                            <?php foreach ($salesmen as $s): ?>
                                "<?= addslashes($s->last_name) ?>",
                            <?php endforeach; ?>
                        ],
                        datasets: [{
                            label: "Total Remittance",
                            fillColor: "rgba(76, 175, 80, 0.6)",
                            strokeColor: "rgba(56, 142, 60, 1)",
                            highlightFill: "rgba(129, 199, 132, 0.8)",
                            highlightStroke: "rgba(102, 187, 106, 1)",
                            data: [
                                <?php foreach ($salesmen as $s): ?>
                                    <?= number_format($s->total_remittance, 2, '.', '') ?>,
                                <?php endforeach; ?>
                            ]
                        }]
                    };

                    var options = {
                        responsive: true,
                        scaleBeginAtZero: true,
                        barShowStroke: true,
                        barStrokeWidth: 1,
                        barValueSpacing: 10, // Adds more spacing between bars
                        barDatasetSpacing: 2,

                        scaleFontSize: 12,
                        scaleFontColor: "#555",
                        scaleGridLineColor: "rgba(0,0,0,.05)",
                        scaleLineColor: "rgba(0,0,0,.1)",

                        tooltipFillColor: "rgba(0,0,0,0.7)",
                        tooltipFontSize: 13,
                        tooltipFontColor: "#fff",
                        tooltipCornerRadius: 4,
                        tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= Number(value).toLocaleString() %>",

                        animation: true,
                        animationSteps: 60,
                        animationEasing: "easeOutQuart",

                        // Custom legend (optional)
                        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\">" +
                            "<% for (var i=0; i<datasets.length; i++){%>" +
                            "<li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span>" +
                            "<%=datasets[i].label%></li><%}%></ul>"
                    };

                    new Chart(ctx).Bar(data, options);
                </script>

            <?php else: ?>
                <p>No data found for the selected filters.</p>
            <?php endif; ?>


        

    </div>
</main>