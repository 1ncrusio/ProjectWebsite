<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple Charts</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="form-group">
            <label for="search">Pilih Lantai</label>
            <select name="search" id="search" class="form-control">
                <option value="">Pilih Lantai</option>
                @foreach($alatOpsi as $opsi)
                <option value="{{ $opsi }}">{{ $opsi }}</option>
                @endforeach
            </select>
        </div>
        <button id="searchButton" class="btn btn-primary">Cari</button>
    </div>

    <div class="charts-container">
        <!-- Container for charts -->
    </div>

    <script>
        $(document).ready(function () {
            $("#searchButton").click(function () {
                var selectedFloor = $("#search").val();

                $.get('{{url('cari')}}' + selectedFloor, function (data) {
                    // Loop through each set of data for each code
                    for (var i = 0; i < data.length; i++) {
                        var chartData = data[i];

                        // Create canvas element for each chart
                        var canvas = document.createElement('canvas');
                        canvas.id = 'chart_' + chartData.code;
                        canvas.width = 400;
                        canvas.height = 200;

                        // Append canvas to charts container
                        document.querySelector('.charts-container').appendChild(canvas);

                        var ctx = canvas.getContext('2d');

                        // Create new chart for each code
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: chartData.labels,
                                datasets: [{
                                    label: 'Data 1',
                                    data: chartData.data1,
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1
                                }, {
                                    label: 'Data 2',
                                    data: chartData.data2,
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                }, {
                                    label: 'Data 3',
                                    data: chartData.data3,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
<!-- <div class="d-flex justify-content-center">
                                        {{ $alat->links() }}
                                        </div> -->
<!-- <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart1 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($mergedData['label']) !!},
            datasets: [{
                label: 'Value Current ( A )',
                data: {!! json_encode($mergedData['data1']) !!}, // Contoh data dari tabel 1
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },{
                label: 'Value Power ( W )',
                data: {!! json_encode($mergedData['data2']) !!}, // Contoh data dari tabel 2
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },{
                label: 'Value Volt ( V )',
                data: {!! json_encode($mergedData['data3']) !!}, // Contoh data dari tabel 3
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        var ctx1 = document.getElementById('Lantai1Chart').getContext('2d');
        var myChart = new Chart(ctx1, {
            type: 'line', // Ubah menjadi 'line' untuk membuat grafik garis
        data: {
            labels: {!! json_encode($mergedData['label']) !!},
            datasets: [{
                label: 'Value Current ( A )',
                data: {!! json_encode($mergedData['data1']) !!}, // Contoh data dari tabel 1
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },{
                label: 'Value Power ( W )',
                data: {!! json_encode($mergedData['data2']) !!}, // Contoh data dari tabel 2
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },{
                label: 'Value Volt ( V )',
                data: {!! json_encode($mergedData['data3']) !!}, // Contoh data dari tabel 3
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script> -->
    <script>
    $(document).ready(function() {
    $("#searchButton").click(function() {
        var value = $("#search").val().toLowerCase();
        $("#data-table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
        });

    $("#search").change(function() {
        var selectedFloor = $(this).val().toLowerCase();

    // Check if a valid floor is selected (not empty or default)
    if (selectedFloor) {
      $.get('/fetch-data/' + selectedFloor, function(data) {
        // Update chart data and configuration here
        // Example: Update chart datasets with data from response
        lt1.data.labels = data.labels;
        lt1.data.datasets[0].data = data.data1;
        lt1.data.datasets[1].data = data.data2;
        lt1.data.datasets[2].data = data.data3;
        lt1.update();

    });
    }
    });
});
    </script>