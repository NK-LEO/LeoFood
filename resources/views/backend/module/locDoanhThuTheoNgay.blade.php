<p>Tổng doanh thu từ ngày {{ date("d-m-Y", strtotime($ngaytu)) }} đến ngày {{ date("d-m-Y", strtotime($ngayden)) }} là: <span style="background-color: yellow; padding: 0 3px">{{ number_format($tongdoanhthu,0,'.','.') }}<sup>VNĐ</sup></span></p>
<canvas id="myChart" height="100"></canvas>
<script>
    var ctx = document.getElementById('myChart');
    var temp = "{{ $thangnam }}";
    var tmp = temp.split(", "); //Chuyển chuỗi thành mảng
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: tmp,
            datasets: [{
                label: 'Doanh thu',
                data: {{ $tongtien }},
                backgroundColor: '#B0E0E6',
                maxBarThickness: 50,
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Biểu đồ doanh thu từ ngày {{ date("d-m-Y", strtotime($ngaytu)) }} đến ngày {{ date("d-m-Y", strtotime($ngayden)) }}',
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