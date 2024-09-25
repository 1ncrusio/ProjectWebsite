@extends('layouts.master')

@section('content')
<div class="main-content"> <section class="section"> <div class="section-header"> <h1>Kalkulasi Biaya</h1> </div>
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>KwH</h4>
                <div class="card-header-action">
                    <a href="#" class="btn active">Week</a>
                    <a href="#" class="btn">Month</a>
                    <a href="#" class="btn">Year</a>
                </div>
            </div>
            <div class="card-body">
                <canvas id="myChart2" height="180"></canvas>
                <div class="statistic-details mt-1">
                    <div class="statistic-details-item">
                        <div class="text-small text-muted"><span class="text-primary"><i
                                    class="fas fa-caret-up"></i></span>
                            7%
                        </div>
                        <div class="detail-value">$243</div>
                        <div class="detail-name">Today</div>
                    </div>
                    <div class="statistic-details-item">
                        <div class="text-small text-muted"><span class="text-danger"><i
                                    class="fas fa-caret-down"></i></span> 23%
                        </div>
                        <div class="detail-value">$2,902</div>
                        <div class="detail-name">This Week</div>
                    </div>
                    <div class="statistic-details-item">
                        <div class="text-small text-muted"><span class="text-primary"><i
                                    class="fas fa-caret-up"></i></span>9%</div>
                        <div class="detail-value">$12,821</div>
                        <div class="detail-name">This Month</div>
                    </div>
                    <div class="statistic-details-item">
                        <div class="text-small text-muted"><span class="text-primary"><i
                                    class="fas fa-caret-up"></i></span>
                            19%
                        </div>
                        <div class="detail-value">$92,142</div>
                        <div class="detail-name">This Year</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Perkiraan Biaya Pengunaan Listrik</h4>
            </div>
            <div class="card-body">
                <div class="row">
    <div class="col-md-2">
        <label>Month 1</label>
        <input type="month" class="form-control">
    </div>
    <div class="col-md-2">
        <label>Month 2</label>
        <input type="month" class="form-control">
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label> Harga KwH</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">IDR</span>
                </div>
                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                <div class="input-group-append">
                    <span class="input-group-text">.000</span>
                </div>
            </div>
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Hitung</button>
        </div>
    </div>
</div>


            <div class="row">
                <div class="col-12 ">
                    <div class="card">
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
@endsection