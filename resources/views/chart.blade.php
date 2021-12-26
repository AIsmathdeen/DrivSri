<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>

<body>

<div id="container"></div>
</body>

<script src="https://code.highcharts.com/highcharts.js"></script>
<div id="chart-container"></div>
<script>
    var datas =  <?php echo json_encode($datas) ?>;

    Highcharts.chart('chart-container', {
        title: {
            text: 'Road Rule Violations- 2021'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Number of Ofeence'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Offence',
            data: datas
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
});
</script>
</html>
