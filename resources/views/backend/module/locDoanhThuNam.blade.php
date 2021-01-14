<p>Tổng doanh thu năm {{ $nam }} là <span style="background-color: yellow; padding: 0 3px">{{ number_format($tongdoanhthu,0,'.','.') }}<sup>VNĐ</sup></span></p>
<canvas id="myChart" height="100"></canvas>
<script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {{ json_encode($thang) }},
            datasets: [{
                label: 'Doanh thu',
                data: {{ json_encode($tongtien) }},
                backgroundColor: '#B0E0E6',
                maxBarThickness: 50,
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Biểu đồ doanh thu các tháng trong năm {{ $nam }}',
                fontSize: 20,
            },
            legend: {
                // display: false,
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>