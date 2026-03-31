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
                        <div class="h1 <?= $pnl_total > 0 ? 'text-green' : 'text-red' ?>" id="pnl_total">$<?= $pnl_total ?></div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="subheader">PNL History</div>
                        <div class="h1 <?= $pnl_history > 0 ? 'text-green' : 'text-red' ?>" id="pnl_history">$<?= $pnl_history ?></div>
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
            <div class="col-6">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="subheader">Current Signal</div>
                        <div class="display-3 fw-bold" id="signal"><?= $signal ?></div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h2 class="card-title">Current Position</h2>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Symbol:</strong> <span id="symbol"><?= $trade_active['symbol'] ?></span>
                            </li>
                            <li class="list-group-item">
                                <strong>Entry Time:</strong> <span id="entry-time"><?= $trade_active['entry_time'] ?></span>
                            </li>
                            <li class="list-group-item">
                                <strong>Entry Price:</strong> <span id="entry-price"><?= $trade_active['entry_price'] ?></span>
                            </li>
                            <li class="list-group-item">
                                <strong>Quantity:</strong> <span id="quantity"><?= $trade_active['qty'] ?></span>
                            </li>
                            <li class="list-group-item">
                                <strong>PnL:</strong> <span id="pnl"><?= $pnl_active ?? '-' ?></span>
                            </li>
                            <li class="list-group-item">
                                <strong>Status:</strong> <span id="status"><?$trade_active['status']?></span>
                            </li>
                            <li class="list-group-item">
                                <strong>Stop Loss:</strong> <span id="stop-loss"></span>
                            </li>
                            <li class="list-group-item">
                                <strong>Take Profit:</strong> <span id="take-profit"></span>
                            </li>
                        </ul>
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