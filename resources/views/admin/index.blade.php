@extends('layouts.master')

@section('content')
<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
<div class="row">
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
            </div>
            <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Aktifitas </h4>
                        </div>
                        <div class="card-body">
                            <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pilih Dataset
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#" onclick="showDataset('data1')">Value Current (A)</a>
                                <a class="dropdown-item" href="#" onclick="showDataset('data2')">Value Power (W)</a>
                                <a class="dropdown-item" href="#" onclick="showDataset('data3')">Value Volt (V)</a>
                            </div>
                        </div>
                        <div class="charts-container">
                            <canvas id="myChart" width="200" height="100"></canvas>
                            
                        </div>
                        
                        <div class="row mt-3">
          
        <div class="col-md-2">
            <label>Month 1</label>
            <input type="month" class="form-control">
        </div>
        <div class="col-md-2">
            <label>Month 2</label>
            <input type="month" class="form-control">
        </div>
    
        <div class="col-md-2" id="CariBox">
            <form>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" placeholder="Cari..." name="query">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
                           
                
                
                        <div class="card-header">
                            <h4>Simple</h4>
                            <button class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">edit</button>
                            <div class="card-header-action">
                                <a href="#" class="btn active">Week</a>
                                <a href="#" class="btn">Month</a>
                                <a href="#" class="btn">Year</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            
            <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($mergedData['dataset']['label']) !!},
            datasets: [{
                label: 'Value Current ( A )',
                data: {!! json_encode($mergedData['dataset']['data1']) !!}, // Contoh data dari tabel 1
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },{
                label: 'Value Power ( W )',
                data: {!! json_encode($mergedData['dataset']['data2']) !!}, // Contoh data dari tabel 2
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },{
                label: 'Value Volt ( V )',
                data: {!! json_encode($mergedData['dataset']['data3']) !!}, // Contoh data dari tabel 3
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
    
@endsection