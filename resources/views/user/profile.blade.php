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
        <h1>Profile</h1> 
        <div>

            </div>
          </div>
          <div class="section-body">
            <h2 class="section-title">Hi, {{ Auth::user()->name }}</h2>
            <p class="section-lead">
              Change information about yourself on this page.
            </p>

            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                  <div class="profile-widget-header">
                    <img alt="image" src="{{ asset('template/') }}/assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture">
                    
                  </div>
                  <div class="profile-widget-description">
                    <div class="profile-widget-name">{{ Auth::user()->name }} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> {{ Auth::user()->email }}</div></div>
                  </div>
                  
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                  
                <form id="editForm" method="POST" enctype="multipart/form-data" action="{{ route('updateData', $item->id) }}">
    @csrf
    <div class="form-group">
        <label>Nama </label>
        <input id="name" type="text"
            class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ old('name', $item->name) }}" required autocomplete="name" autofocus>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label>Email</label>
        <input id="email" type="email"
            class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ old('email', $item->email) }}" required autocomplete="email" autofocus>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password"
            class="form-control @error('password') is-invalid @enderror" name="password"
             autocomplete="new-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="password-confirm">{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" class="form-control"
            name="password_confirmation"  autocomplete="new-password">
    </div>
    <!-- <label>{{ __('Role') }}</label>
                                        <div class="form-group">
                                            <select name="role" class="form-control" required>
                                                <option value="user"{{ old('role') == 'user' ? ' selected' : '' }}>User</option>
                                                <option value="admin"{{ old('role') == 'admin' ? ' selected' : '' }}>Admin</option>
                                            </select>
                                        </div> -->
    <div class="form-group">
        <label class="font-weight-bold">Gambar</label>
        <input type="hidden" id="oldImage" name="oldImage" value="{{ $item->gambar }}">
        <input type="file" class="form-control" name="gambar">
    </div>
    <div class="form-group">
        <img src="{{ asset('storage/' . $item->gambar) }}" height="40%" width="40%">
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-md btn-primary">Simpan</button>
    </div>
</form>

                        
                </div>
              </div>
            </div>
          </div>
        </section>
        
  @endsection