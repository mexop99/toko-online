@extends('layouts.global')
@section('title')
Create User
@endsection
@section('pageTitle')
Create User
@endsection

@section('content')
<div class="col-md-8">

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('status-fail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('status-fail') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    {{-- FORM ADD USER --}}
    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data"
        class="bg-white shadow-sm p-3">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input value="{{ old('name') }}" type="text" class="form-control {{ $errors->first('name') ? "is-invalid":""}}" placeholder="Full Name" name="name" id="name">
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input value="{{ old('username') }}" type="text" class="form-control {{ $errors->first('username') ? "is-invalid":""}}" placeholder="username" name="username" id="username">
            <div class="invalid-feedback">
                {{ $errors->first('username') }}
            </div>
        </div>

        <div class="form-group">
            <label for="">Roles</label>
            <input type="checkbox" class="form-control {{ $errors->first('roles') ? "is-invalid":""}}" name="roles[]" id="ADMIN" value="ADMIN">
            <label for="ADMIN">ADMINISTRATOR</label>

            <input type="checkbox" class="form-control {{ $errors->first('roles') ? "is-invalid":""}}" name="roles[]" id="STAFF" value="STAFF">
            <label for="STAFF">STAFF</label>

            <input type="checkbox" class="form-control {{ $errors->first('roles') ? "is-invalid":""}}" name="roles[]" id="CUSTOMER" value="CUSTOMER">
            <label for="CUSTOMER">CUSTOMER</label>
            <div class="invalid-feedback">
                {{ $errors->first('roles') }}
            </div>
        </div>

        <div class="form-group">
            <label for="address">Adress</label>
            <textarea name="address" id="address" cols="30" rows="4" class="form-control {{ $errors->first('address') ? "is-invalid":""}}">{{ old('address')}}</textarea>
            <div class="invalid-feedback">
                {{ $errors->first('address') }}
            </div>
        </div>

        <div class="form-group">
            <label for="avatar">Avatar</label>
            <input value="{{ old('avatar') }}" type="file" name="avatar" id="avatar" class="form-control {{ $errors->first('avatar') ? "is-invalid":""}}">
            <div class="invalid-feedback">
                {{ $errors->first('avatar') }}
            </div>
        </div>

        <hr class="my-3">

        <div class="form-group">
            <label for="email">Email</label>
            <input value="{{ old('email') }}" type="email" name="email" id="email" class="form-control {{ $errors->first('email') ? "is-invalid":""}}" placeholder="Email">
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        </div>

        <div class="form-group">
            <label for="password">password</label>
            <input type="password" name="password" id="password" placeholder="Password" class="form-control {{ $errors->first('password') ? "is-invalid":""}}">
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
        </div>

        <div class="form-group">
            <label for="password2">Konfirmasi Password</label>
            <input type="password" name="password2" id="password2" placeholder="Konfirmasi Password"
                class="form-control {{ $errors->first('password2') ? "is-invalid":""}}">
                <div class="invalid-feedback">
                    {{ $errors->first('password2') }}
                </div>
        </div>

        <button type="submit" class="btn btn-primary">
            <span class="oi oi-check"></span> Save</button>
        <a href="{{ route('users.index') }}" class="btn btn-danger">
            <span class="oi oi-x"></span> Cancel</a>
    </form>

</div>
@endsection
