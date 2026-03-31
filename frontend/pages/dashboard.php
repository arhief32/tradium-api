<div aria-label="Page header" class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- <div class="page-pretitle">Dashboard</div> -->
                <h2 class="page-title">Dashboard</h2>
            </div>
            <div class="col-auto ms-auto d-print-none"></div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">

        <!-- 🔥 SUMMARY -->
        <div class="row row-deck row-cards">

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="subheader">Balance</div>
                        <div class="h1" id="balance">$ <?= $balance ?></div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="subheader">PNL Total</div>
                        <div class="h1 <?= $total_pnl > 0 ? 'text-green' : 'text-red' ?>" id="total_pnl">$<?= $total_pnl ?></div>
                        
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="subheader">PNL Active</div>
                        <div class="h1 <?= $pnl > 0 ? 'text-green' : 'text-red' ?>" id="pnl">$<?= $pnl ?></div>
                        
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="subheader">Bot Status</div>
                        <div class="h1" id="bot-status"><?= $bot_status ?></div>
                    </div>
                </div>
            </div>

        </div>

        <!-- 🤖 SIGNAL -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="card text-center">
                    <div class="card-body">

                        <div class="subheader">Current Signal</div>
                        <div class="display-3 fw-bold" id="signal"><?= $signal ?></div>

                    </div>
                </div>
            </div>
        </div>

        <!-- 📊 CHART -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Chart (SMA 5 vs SMA 10)</h3>
                    </div>
                    <div class="card-body">
                        <div id="chart-sma"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    const sma5 = <?= json_encode($sma5) ?>;
    const sma10 = <?= json_encode($sma10) ?>;
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const labels = sma5.map((_, i) => i + 1);

        var options = {
            chart: {
                type: 'line',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            series: [{
                    name: 'SMA 5',
                    data: sma5
                },
                {
                    name: 'SMA 10',
                    data: sma10
                }
            ],
            xaxis: {
                categories: labels
            },
            stroke: {
                width: 2
            },
            colors: ['#206bc4', '#d63939']
        };

        var chart = new ApexCharts(document.querySelector("#chart-sma"), options);
        chart.render();

    });
</script>