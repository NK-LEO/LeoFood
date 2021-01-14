@if (!empty($chitietdonhang->toArray()))
    <canvas id="myChart" height="100"></canvas>
    <br>
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div>
                    <table class="table" ui-jq="footable" ui-options='{
                        "paging": {
                        "enabled": true
                        },
                        "filtering": {
                        "enabled": true
                        },
                        "sorting": {
                        "enabled": true
                        }}'>
                        <thead>
                            <tr class="row">
                                <th class="col-md-2">STT</th>
                                <th class="col-md-2">TÊN SẢN PHẨM</th>
                                <th class="col-md-4" style="text-align: center">HÌNH ẢNH</th>
                                <th class="col-md-2" style="text-align: center">GIÁ</th>
                                <th class="col-md-2" style="text-align: center">SỐ LƯỢNG ĐÃ BÁN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                                @foreach ($chitietdonhang as $ctdh)
                                <tr class="row">
                                    <td class="col-md-2" style="height: 50px; line-height: 50px;">
                                        {{ $i }}
                                    </td>
                                    <td class="col-md-2" style="height: 50px; line-height: 50px;">
                                        {{ $ctdh->sanpham->ten_sp }}
                                    </td>
                                    <td class="col-md-4" style="height: 50px; line-height: 50px; text-align: center">
                                        <img src="{{ $ctdh->sanpham->hinh_sp }}" style="width: 75px; height: 50px">
                                    </td>
                                    <td class="col-md-2" style="height: 50px; line-height: 50px; text-align: center">
                                        {{ number_format($ctdh->sanpham->gia_sp,0,'.','.') }}<sup>VNĐ</sup>
                                    </td>
                                    <td class="col-md-2" style="height: 50px; line-height: 50px; text-align: center">
                                        {{ $ctdh->tongsoluong }}
                                    </td>
                                    @php
                                    $i++;
                                    @endphp
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@else
    <div class="row">
        <div class="col-md-12" style="text-align: center; background-color: #fafafa;">
            <img src="/public/backend/images/bot2.jpg" style="width: 400px; height: 300px">
            <h5>Không có kết quả</h5>
        </div>
    </div>
@endif
@if (!empty($chitietdonhang->toArray()))
<script>
    var ctx = document.getElementById('myChart');
    var temp = "{{ $tensanpham }}";
    var tmp = temp.split(", "); //Chuyển chuỗi thành mảng
    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
    labels: tmp,
    datasets: [{
    label: 'Số lượng đã bán',
    data: {{ $tongsoluong }},
    backgroundColor: '#5F9EA0',
    maxBarThickness: 50,
    }]
    },
    options: {
    title: {
    display: true,
    text: 'Biểu đồ thống kê sản phẩm bán được trong tháng {{ $month }} năm {{ $year }}',
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
@endif