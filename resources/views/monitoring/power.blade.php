@extends('layouts.master')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Monitoring</h1>
      <h6>Power</h6>
    </div>
    <div class="col-12 col-sm-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4>AC Power</h4>
        </div>
        <div class="card-body">
          <canvas id="myChart" width="400" height="200"></canvas>

          <!-- <div class="mb-4 mt-4">
            <div class="text-small float-right font-weight-bold text-muted">558</div>
            <div class="font-weight-bold mb-1">Google</div>
            <div class="progress" data-height="3">
              <div class="progress-bar" role="progressbar" data-width="80%" aria-valuenow="80" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
          </div>

          <div class="mb-4">
            <div class="text-small float-right font-weight-bold text-muted">338</div>
            <div class="font-weight-bold mb-1">Facebook</div>
            <div class="progress" data-height="3">
              <div class="progress-bar" role="progressbar" data-width="67%" aria-valuenow="25" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
          </div>

          <div class="mb-4">
            <div class="text-small float-right font-weight-bold text-muted">238</div>
            <div class="font-weight-bold mb-1">Bing</div>
            <div class="progress" data-height="3">
              <div class="progress-bar" role="progressbar" data-width="58%" aria-valuenow="25" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
          </div>

          <div class="mb-4">
            <div class="text-small float-right font-weight-bold text-muted">190</div>
            <div class="font-weight-bold mb-1">Yahoo</div>
            <div class="progress" data-height="3">
              <div class="progress-bar" role="progressbar" data-width="36%" aria-valuenow="25" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
          </div> -->
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 ">
        <div class="card">
          <div class="card-header">
            <h4>Simple</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">edit</button>
          </div>
          <div class="card-body">
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">code alat</th>
                    <th scope="col">Power</th>
                    <th scope="col">Tanggal</th>
                  </tr>
                </thead>
                <?php
          $no = 0;
          
          ?>
                <tbody>
                  @foreach ($data as $item)
                  <tr>
                    <th scope="row">{{$no++}}</th>
                    <td>{{$item->code}}</td>
                    <td>{{$item->val_power}}</td>
                    <td>{{$item->tgl}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <div class="card-footer text-right">
              <nav class="d-inline-block">
                <ul class="pagination mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                  </li>
                  <li class="page-item active"><a class="page-link" href="#">1 <span
                        class="sr-only">(current)</span></a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">2</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Modal body text goes here.</p>
          </div>
          <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: {!! json_encode($data-> pluck('tgl'))!!},
  datasets: [{
    label: 'Value Power',
    data: {!! json_encode($data-> pluck('val_power')) !!},
    backgroundColor: 'rgba(75, 192, 192, 0.2)',
    borderColor: 'rgba(75, 192, 192, 1)',
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