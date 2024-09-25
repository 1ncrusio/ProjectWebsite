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
                <h1>Tambah Perangkat</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-user fa-fw"></i> Form Tambah
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <form role="form" enctype="multipart/form-data" method="POST"
                                    action="{{ route('tambah') }}">
                                    @csrf
                                    <fieldset>
                                        <label for="code">{{ __('code') }}</label>
                                        <div class="form-group">
                                            <input id="code" type="text"
                                                class="form-control @error('code') is-invalid @enderror" name="code"
                                                value="{{ old('code') }}" required autocomplete="code" autofocus>

                                            @error('code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="lantai">{{ __('lantai') }}</label>
                                        <div class="form-group">
                                            <input id="lantai" type="lantai"
                                                class="form-control @error('lantai') is-invalid @enderror" name="lantai"
                                                value="{{ old('lantai') }}" required autocomplete="lantai" autofocus>
                                            @error('lantai')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="ruangan">{{ __('ruangan') }}</label>
                                        <div class="form-group">
                                            <textarea id="ruangan" type="ruangan" class="form-control @error('ruangan') is-invalid @enderror" name="ruangan"
                                                value="{{ old('ruangan') }}" required autocomplete="ruangan"></textarea>
                                            @error('ruangan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                       
                                        <button type="submit" class="btn  btn-success btn-block">
                                            {{ __('Tambah') }}
                                        </button>
                                    </fieldset>
                                </form>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    </div>
                    <!-- /.col-lg-8 -->
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-user fa-fw"></i> New
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="list-group">
                                    @foreach ($alat as $item)
                                        <div class="list-group-item">
                                            <i class="fa fa-user fa-fw"></i> {{ $item->code }}
                                            <span class="pull-right text-muted small"><em>{{ $item->updated_at }}</em>
                                            </span>
                                        </div>
                                    @endforeach

                                </div>
                                <!-- /.list-group -->
                                {{-- <a href="#" class="btn btn-default btn-block">View All Alerts</a> --}}
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel .chat-panel -->
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
            </div>
        </section>
    </div>
@endsection
