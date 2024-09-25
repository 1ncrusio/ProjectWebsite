@extends('layouts.master')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Monitoring Peralat</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-lg">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-user fa-fw"></i> Pencarian
                            </div>
                                <div class="panel-body">
                                <fieldset>
                                    <div class="form-group">
                                        <label>Pilih Alat</label>
                                        <select name="search" id="search" class="form-control">
                                            <option value="">Pilih Alat</option>
                                            @foreach($alatOpsi as $opsi)
                                                <option value="{{ $opsi }}">{{ $opsi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button id="searchButton" class="btn btn-primary">Cari</button>
                                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-user fa-fw"></i> Data Alat
                            </div>
                            <div class="panel-body">
                                @if($alatOpsi->isNotEmpty())
                                    <div class="table-responsive">
                                        <table id="data-table" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Lantai</th>
                                                    <th scope="col">Ruangan</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Data Terakhir</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableBody">
                                                <!-- Data tabel akan dimasukkan di sini -->
                                            </tbody>
                                        </table>
                                        
                                </fieldset>
                                
            
        
                            </div>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="card-body">
                            <div class="charts-container">
                                
                            </div>
                        </div>
                            
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/chart.js"></script>

    <script>
    $(document).ready(function () {
    // Fungsi untuk mereset atau menyembunyikan tabel saat tidak ada alat yang dipilih
    function resetTable() {
        $('#data-table tbody').empty(); // Kosongkan isi dari tabel
        $('#data-table').hide(); // Sembunyikan tabel
    }

    // Handler untuk perubahan pilihan alat
    $('#search').change(function () {
        // Reset atau sembunyikan tabel jika tidak ada alat yang dipilih
        if ($(this).val() === '') {
            resetTable();
        }
    });

    // Handler untuk tombol cari
    $('#searchButton').click(function () {
        var selectedAlat = $('#search').val();

        // Reset atau sembunyikan tabel jika tidak ada alat yang dipilih
        if (selectedAlat === '') {
            resetTable();
            return; // Hentikan eksekusi fungsi
        }

        // Lakukan permintaan AJAX untuk mendapatkan data alat berdasarkan pilihan
        $.get('/get-data', { alat: selectedAlat }, function (response) {
            if (response.length > 0) {
                // Kosongkan isi tabel sebelum menambahkan data baru
                $('#data-table tbody').empty();

                // Tambahkan data alat ke dalam tabel
                $.each(response, function (index, alat) {
                    var row = '<tr>' +
                        '<td>' + (index + 1) + '</td>' +
                        '<td>' + alat.lt + '</td>' +
                        '<td>' + alat.ruangan + '</td>' +
                        '<td>' + alat.status_alat + '</td>' +
                        '<td>' + alat.latestLabel + '</td>' +
                        '</tr>';
                    $('#data-table tbody').append(row);
                });

                // Tampilkan kembali tabel
                $('#data-table').show();
            } else {
                // Jika tidak ada data alat yang ditemukan, reset atau sembunyikan tabel
                resetTable();
            }
        });
    });
});

</script>

    
    <script>
   $(document).ready(function () {
    var chartCount = 0; // Variabel untuk melacak jumlah chart yang sudah dibuat

    // Fungsi untuk mereset chart JS
    function resetCharts() {
        chartCount = 0; // Reset chartCount ke nilai awalnya
        $(".charts-container").empty(); // Hapus semua chart dari DOM
    }

    // Handler untuk perubahan pilihan lantai
    $("#search").change(function () {
        // Reset chart JS jika tidak ada lantai yang dipilih
        if ($(this).val() === "") {
            resetCharts();
            return; // Hentikan eksekusi fungsi
        }
    });

    $("#searchButton").click(function () {
        var selectedAlat = $("#search").val();

        // Reset chart JS jika tidak ada lantai yang dipilih
        if (selectedAlat === "") {
            resetCharts();
            return; // Hentikan eksekusi fungsi
        }

        $.get('{{url('alat')}}' + selectedAlat, function (data) {
    // Reset chart JS sebelum membuat yang baru
    resetCharts();

    // Loop through each data alat pada lantai yang dipilih
    for (var i = 0; i < data.length; i++) {
        var chartData = data[i];

        // Create canvas element for each chart
        var canvas = document.createElement('canvas');
        canvas.id = 'chart_' + chartData.code + '_' + i;
        canvas.width = 400;
        canvas.height = 200;

        // Create title for the chart
        var chartTitle = document.createElement('div');
        chartTitle.innerHTML = 'Chart Alat: ' + chartData.code; // Ganti chartData.code dengan nilai code alat
        document.querySelector('.charts-container').appendChild(chartTitle);
        document.querySelector('.charts-container').appendChild(canvas);
        var ctx = canvas.getContext('2d');

        // Create new chart for each code
        if (chartCount == 0) { // Pertama, buat chart tipe bar
            var barChart = new Chart(ctx, {
                type: 'bar', // Gunakan tipe bar
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Value Current (A)',
                        data: chartData.data1,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Value Power (W)',
                        data: chartData.data2,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Value Volt (V)',
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
        } else { // Kedua, buat chart tipe line
            var lineChart = new Chart(ctx, {
                type: 'bar', // Gunakan tipe line
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Value Current (A)',
                        data: chartData.data1,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        fill: false // Tidak diisi (line chart)
                    }, {
                        label: 'Value Power (W)',
                        data: chartData.data2,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        fill: false // Tidak diisi (line chart)
                    }, {
                        label: 'Value Volt (V)',
                        data: chartData.data3,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false // Tidak diisi (line chart)
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
        chartCount++; // Tambahkan 1 ke jumlah chart yang sudah dibuat
    }
});
});
});

</script>




@endsection
