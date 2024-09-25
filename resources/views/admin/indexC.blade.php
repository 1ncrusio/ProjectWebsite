@extends('layouts.master')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <!-- Statistik Card -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total User</h4>
                        </div>
                        <div class="card-body">
                            {{ $user }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Statistik Card -->

            <!-- Statistik Card untuk Status Alat -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Status Alat</h4>
                        </div>
                        <div class="card-body">
                            <h5> Online : {{ $nyala }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Status Alat</h4>
                        </div>
                        <div class="card-body">
                            <h5> Offline : {{ $off }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jumlah Alat</h4>
                        </div>
                        <div class="card-body">
                            {{ $alat }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Statistik Card untuk Status Alat -->
        </div>

        <!-- Grafik dan Tabel untuk Data Arus (Current) -->
        <div class="row">
            <div class="col-12">
            <div>
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate">
                
                <label for="endDate">End Date:</label>
                <input type="date" id="endDate">
                
                <button onclick="filterData()">Filter</button>
            </div>
                <div style="display: flex; justify-content: space-around;">
                    <!-- Grafik Arus (Current) -->
                    <div>
                        <div class="card">
                            <div class="card-header">
                                Arus (Current)
                            </div>
                            <div class="card-body">
                                <canvas id="currentChart"height="300"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel untuk Data Arus (Current) -->
                    <div>
                        <div class="card">
                            <div class="card-header">
                                Tabel Arus (Current)
                            </div>
                            <div class="card-body">
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Current (A)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="currentTableBody">
                                        <!-- Isi tabel akan ditambahkan melalui JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Grafik dan Tabel untuk Data Arus (Current) -->

        <!-- Grafik dan Tabel untuk Data Power -->
        <div class="row">
            <div class="col-12">
                <div style="display: flex; justify-content: space-around;">
                    <!-- Grafik Power -->
                    <div>
                        <div class="card">
                            <div class="card-header">
                                Power
                            </div>
                            <div class="card-body">
                                <canvas id="powerChart"height="300"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel untuk Data Power -->
                    <div>
                        <div class="card">
                            <div class="card-header">
                                Tabel Power
                            </div>
                            <div class="card-body">
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Power (W)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="powerTableBody">
                                        <!-- Isi tabel akan ditambahkan melalui JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Grafik dan Tabel untuk Data Power -->

        <!-- Grafik dan Tabel untuk Data Volt -->
        <div class="row">
            <div class="col-12">
                <div style="display: flex; justify-content: space-around;">
                    <!-- Grafik Volt -->
                    <div>
                        <div class="card">
                            <div class="card-header">
                                Volt
                            </div>
                            <div class="card-body">
                                <canvas id="voltageChart"height="300"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel untuk Data Volt -->
                    <div>
                        <div class="card">
                            <div class="card-header">
                                Tabel Volt
                            </div>
                            <div class="card-body">
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Voltage (V)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="voltageTableBody">
                                        <!-- Isi tabel akan ditambahkan melalui JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Grafik dan Tabel untuk Data Volt -->
    </section>
</div>

                        
                       
                
            
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@1.0.2"></script>

            <script>
        // Data dari controller (Anda perlu menyesuaikan sesuai dengan struktur data yang dikirimkan)
        var labels = {!! json_encode($labels) !!};
        var dataCurrent = {!! json_encode($dataCurrent) !!};
        var dataPower = {!! json_encode($dataPower) !!};
        var dataVoltage = {!! json_encode($dataVoltage) !!};
        
        function createTableRow(tableBody, labels, data, currentPage = 1, itemsPerPage = 10) {
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = Math.min(startIndex + itemsPerPage, data.length);

            tableBody.innerHTML = ""; // Kosongkan tabel sebelum diisi ulang

            for (var i = startIndex; i < endIndex; i++) {
                var row = "<tr><td>" + (i + 1 - startIndex) + "</td><td>" + labels[i] + "</td><td>" + data[i] + "</td></tr>";
                tableBody.innerHTML += row;
            }
        }


        // Buat tabel untuk data arus (current)
        var currentTableBody = document.getElementById('currentTableBody');
        createTableRow(currentTableBody, labels, dataCurrent);

        // Buat tabel untuk data daya (power)
        var powerTableBody = document.getElementById('powerTableBody');
        createTableRow(powerTableBody, labels, dataPower);

        // Buat tabel untuk data voltase (voltage)
        var voltageTableBody = document.getElementById('voltageTableBody');
        createTableRow(voltageTableBody, labels, dataVoltage);

        // Buat grafik arus (current)
        var ctxCurrent = document.getElementById('currentChart').getContext('2d');
        var warningLimit = 5;
        var currentChart = new Chart(ctxCurrent, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Current (A)',
                    data: dataCurrent,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
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
                }, plugins: {
                    annotation: {
                        annotations: {
                            line1: {
                                type: 'line',
                                yMin: warningLimit,
                                yMax: warningLimit,
                                borderColor: 'red',
                                borderWidth: 2,
                                label: {
                                    content: 'Warning Limit',
                                    enabled: true,
                                    position: 'center'
                                }
                            }
                        }
                    }
                }
            }
        });
        
        // Buat grafik daya (power)
        var ctxPower = document.getElementById('powerChart').getContext('2d');
        var warningLimit = 100;
        var powerChart = new Chart(ctxPower, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Power (W)',
                    data: dataPower,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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
                },
                plugins: {
                    annotation: {
                        annotations: {
                            line1: {
                                type: 'line',
                                yMin: warningLimit,
                                yMax: warningLimit,
                                borderColor: 'red',
                                borderWidth: 2,
                                label: {
                                    content: 'Warning Limit',
                                    enabled: true,
                                    position: 'center'
                                }
                            }
                        }
                    }
                }
            }
        });


        // Buat grafik voltase (voltage)
        var ctxVoltage = document.getElementById('voltageChart').getContext('2d');
        var warningLimit = 300;
        var voltageChart = new Chart(ctxVoltage, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Voltage (V)',
                    data: dataVoltage,
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
                },
                plugins: {
                    annotation: {
                        annotations: {
                            line1: {
                                type: 'line',
                                yMin: warningLimit,
                                yMax: warningLimit,
                                borderColor: 'red',
                                borderWidth: 2,
                                label: {
                                    content: 'Warning Limit',
                                    enabled: true,
                                    position: 'center'
                                }
                            }
                        }
                    }
                }
            }
        });
                function filterData() {
            // Ambil tanggal awal dan akhir dari input date picker
            var startDate = new Date(document.getElementById('startDate').value);
            var endDate = new Date(document.getElementById('endDate').value);
            
            // Filter data berdasarkan rentang tanggal
            var filteredLabels = [];
            var filteredDataCurrent = [];
            var filteredDataPower = [];
            var filteredDataVoltage = [];

            for (var i = 0; i < labels.length; i++) {
                var currentDate = new Date(labels[i]);
                if (currentDate >= startDate && currentDate <= endDate) {
                    filteredLabels.push(labels[i]);
                    filteredDataCurrent.push(dataCurrent[i]);
                    filteredDataPower.push(dataPower[i]);
                    filteredDataVoltage.push(dataVoltage[i]);
                }
            }

            // Perbarui tabel
            updateTable('currentTableBody', filteredLabels, filteredDataCurrent);
            updateTable('powerTableBody', filteredLabels, filteredDataPower);
            updateTable('voltageTableBody', filteredLabels, filteredDataVoltage);

            // Perbarui chart
            updateChart(currentChart, filteredLabels, filteredDataCurrent);
            updateChart(powerChart, filteredLabels, filteredDataPower);
            updateChart(voltageChart, filteredLabels, filteredDataVoltage);
        }

        function updateTable(tableBodyId, labels, data) {
            var tableBody = document.getElementById(tableBodyId);
            tableBody.innerHTML = "";  // Kosongkan tabel sebelum diisi ulang
            createTableRow(tableBody, labels, data);
        }

        function updateChart(chart, labels, data) {
            chart.data.labels = labels;
            chart.data.datasets[0].data = data;
            chart.update();
        }
        function fetchDataAndUpdateChart() {
    // Lakukan permintaan AJAX ke endpoint yang menyediakan data terbaru
    $.ajax({
        url: 'getLatestData',  // Ganti dengan URL endpoint Anda
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Ubah data dari response ke dalam format yang sesuai untuk Chart.js
            // Misalnya, response harus berisi data yang mirip dengan $currentData, $powerData, $volData

            // Hapus data lama
            chart.data.labels = [];
            chart.data.datasets.forEach((dataset) => {
                dataset.data = [];
            });

            // Masukkan data baru
            response.currentData.forEach((current) => {
                chart.data.labels.push(current.tgl);
                chart.data.datasets[0].data.push(current.val_current);
            });

            response.powerData.forEach((power, index) => {
                chart.data.datasets[1].data.push(power.val_power);
            });

            response.volData.forEach((vol, index) => {
                chart.data.datasets[2].data.push(vol.val_vol);
            });

            // Perbarui chart
            chart.update();
        },
        error: function(error) {
            console.log('Error fetching data:', error);
        }
    });
}

// Setup interval untuk memanggil fetchDataAndUpdateChart setiap 10 detik (misalnya)
setInterval(fetchDataAndUpdateChart, 10000); // Interval dalam milidetik (10000 ms = 10 detik)

    </script>
    
@endsection