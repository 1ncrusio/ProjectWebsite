@extends('layouts.master')

@section('content')
<div class="main-content">
@if (session()->has('success'))
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success"></span> Data telah ditambahkan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        @if (session()->has('destroy'))
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success"></span> Data berhasil dihapus
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif 
    <section class="section"> 
        <div class="section-header"> 
            <h1>Perangkat</h1>
</div>

<div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Perangkat</h4>
                            
                            <div class="card-header-action">
                                
                            
                            </div>
                        </div>
                        <div class="card-body">
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                            <div class="card">
                  
                            <div class="table-responsive">
    <table class="table table-bordered table-md">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Code Alat</th>
                <th scope="col">Lantai</th>
                <th scope="col">Ruangan</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->lt }}</td>
                    <td>{{ $item->ruangan }}</td>
                    <td style="color: {{ $item->statusAlat->status_alat == 'offline' ? 'red' : 'green' }}">
                        {{ $item->statusAlat->status_alat }}
                    </td>
                    <td>
                        <form action="{{ url('edit', ['status_alat' => $item->status_alat, 'statusp' => $item->id_status]) }}" method="post">
                            <!-- @csrf
                            @if ($item->status_alat == 'online')
                                <button class="btn" type="submit"><i class="fa fa-eye-slash" style="color: red;"></i> Offline</button>
                            @else
                                <button class="btn" type="submit"><i class="fa fa-eye" style="color: green;"></i> Online</button>
                            @endif -->
                        </form>
                        <a class="btn" data-toggle="modal" data-target="#editModal{{ $item->id_alat }}"><i class="fa fa-edit"></i></a>
                        <a href="{{ url('hapus', $item->id_alat) }}" class="btn"><i class="fa fa-trash" style="color: red;"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

                  </div>
                               
                                <!-- /.list-group -->
                                {{-- <a href="#" class="btn btn-default btn-block">View All Alerts</a> --}}
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel .chat-panel -->
                    </div>
                        </div>
                    </div>
                </div>
            </div>
</section>
                </div>
                @foreach ($data as $item)
        <div class="modal fade" id="editModal{{ $item->id_alat }}" tabindex="-1" role="dialog"
            aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Perangkat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" method="POST" enctype="multipart/form-data"
                            action="{{ route('update', $item->id_alat) }}">
                            @csrf
                            <div class="form-group">
                                <label>Code </label>
                                <input id="code" type="text"
                                    class="form-control @error('code') is-invalid @enderror" name="code"
                                    value="{{ old('code', $item->code) }}" required autocomplete="code" autofocus>

                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Lantai</label>
                                <input id="lantai" type="text"
                                    class="form-control @error('lantai') is-invalid @enderror" name="lantai"
                                    value="{{ old('lt', $item->lt) }}" required autocomplete="lantai" autofocus>

                                @error('lantai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Ruangan</label>
                                <input id="ruangan" type="text"
                                    class="form-control @error('ruangan') is-invalid @enderror" name="ruangan"
                                    value="{{ old('ruangan', $item->ruangan) }}" required autocomplete="ruangan"
                                    autofocus>

                                @error('ruangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                            <label for="status_alat">Status</label>
                            <select name="id_status" class="form-control" required>
                                @foreach ($status as $statusItem)
                                    <option value="{{ $statusItem->id_status }}" {{ $item->id_status == $statusItem->id_status ? 'selected' : '' }}>
                                        {{ $statusItem->status_alat }}
                                    </option>
                                @endforeach
                            </select>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            @foreach ($data as $item)
                $('#editModal{{ $item->id_alat }}').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var code = button.data('code');
                    var lantai = button.data('lt');
                    var ruangan = button.data('ruangan');
                    var modal = $(this);
                    modal.find('#code{{ $item->id_alat }}').val(title);
                    modal.find('#lt{{ $item->id_alat }}').val(lantai);
                    modal.find('#ruangan{{ $item->id_alat}}').val(ruangan);                  
                });
            @endforeach
        });
    </script>
@endsection

