@extends('layouts.master')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>User</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-user fa-fw"></i> Form Register
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <form role="form" method="POST" action="{{ url('admin') }}">
                                    @csrf
                                    <fieldset>
                                        <label>{{ __('Name') }}</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" required autocomplete="name"
                                                autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label>{{ __('Email Address') }}</label>
                                        <div class="form-group">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                                autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="password">{{ __('Password') }}</label>

                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password-confirm"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">

                                        </div>
                                        <label>{{ __('Role') }}</label>
                                        <div class="form-group">
                                            <select name="role" class="form-control" required>
                                                <option value="user"{{ old('role') == 'user' ? ' selected' : '' }}>User</option>
                                                <option value="admin"{{ old('role') == 'admin' ? ' selected' : '' }}>Admin</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn  btn-success btn-block">
                                            {{ __('Register') }}
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
                                <i class="fa fa-user fa-fw"></i> Data User
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="list-group">
                                    @foreach ($user as $item)
                                        <div class="list-group-item">
                                            <i class="fa fa-user fa-fw"></i> {{ $item->name }}
                                            <span class="pull-right text-muted small"><em>{{ $item->email }}</em>
                                            </span>
                                            {{ $item->role }}
                                            
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
