@extends('layouts.master')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Monitoring</h1>
      <h6>Voltage</h6>
    </div>
    <div class="col-12 col-sm-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4>AC Voltage</h4>
          <div class="card-header-action">
            <a href="#" class="btn active">Week</a>
            <a href="#" class="btn">Month</a>
            <a href="#" class="btn">Year</a>
          </div>
        </div>
        <div class="card-body">
          <canvas id="myChart2" height="170"></canvas>
        </div>
      </div>
      <div class="row">
        <div class="col-12 ">
          <div class="card">
            <div class="card-header">
              <h4>Simple</h4>
              <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">edit</button>
              <div class="col-md-2">
                <label>Month 1</label>
                <input type="month" class="form-control">
              </div>
              <div class="col-md-2">
                <label>Month 2</label>
                <input type="month" class="form-control">
              </div>

            </div>
            <div class="card-body">

              <table class="table">

                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">code alat</th>
                    <th scope="col">Voltage</th>
                    <th scope="col">Tanggal</th>
                  </tr>
                </thead>
                <?php $no = 0; ?>

<tbody>
    @foreach ($data as $item)
    <tr>
        <th scope="row">{{ $no++ }}</th>
        <td>{{ $item->code }}</td>
        <td>{{ $item->val_vol }}</td>
        <td>{{ $item->tgl }}</td>
    </tr>
    @endforeach
</tbody>

</table>
            </div>

            <div class="card-footer text-right">
    
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
  var ctx = document.getElementById('myChart2').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: {!! json_encode($data-> pluck('tgl'))!!},
  datasets: [{
    label: 'Value Volt',
    data: {!! json_encode($data-> pluck('val_vol')) !!},
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