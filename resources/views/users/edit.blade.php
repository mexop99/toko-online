@extends('layouts.global')
@section('title')
| Edit User
@endsection
@section('pageTitle')
Edit User
@endsection

@section('content')
@if(session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<form action="{{ route('users.update', [$user->id]) }}" method="post">
    @csrf
    <input type="hidden" name="_method" value="PUT">

    <div class="col-md-12 text-right">
        <button class="btn btn-primary" type="submit">
            <span class="oi oi-check"></span> Update</button>
    </div>
    <div class="row pl-3 pt-2 mb-5">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-transparent pb-1">
                    <h5>Data User</h5>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input value="{{ old('name') ? old('name') : $user->name }}" type="text" class="form-control {{ $errors->first('name') ? "is-invalid":""}}" placeholder="Full Name"
                            name="name" id="name">
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input value="{{ $user->username }}" type="text" class="form-control" placeholder="username"
                            name="username" id="username" disabled>
                            
                    </div>


                    <div class="form-group">
                        <label for="">Status</label>
                        <div class="form-group">
                            <input value="ACTIVE" type="radio" class="form-control" id="active" name="status"
                                {{ $user->status == "ACTIVE" ? "checked" : "" }}>
                            <label for="active">Active</label>

                            <input value="INACTIVE" type="radio" class="form-control" id="inactive" name="status"
                                {{ $user->status == "INACTIVE" ? "checked" : "" }}>
                            <label for="inactive">Inactive</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Roles</label>
                        <div>
                            <input type="checkbox"
                                {{ in_array("ADMIN", json_decode($user->roles)) ? "checked" : "" }}
                                name="roles[]" id="ADMIN" value="ADMIN" class="form-control {{ $errors->first('roles') ? "is-invalid":""}}">
                            <label for="ADMIN">Administrator</label>

                            <input type="checkbox"
                                {{ in_array("STAFF", json_decode($user->roles)) ? "checked" : "" }}
                                name="roles[]" id="STAFF" value="STAFF" class="form-control {{ $errors->first('roles') ? "is-invalid":""}}">
                            <label for="STAFF">STAFF</label>

                            <input type="checkbox"
                                {{ in_array("CUSTOMER", json_decode($user->roles)) ? "checked" : "" }}
                                name="roles[]" id="CUSTOMER" value="CUSTOMER" class="form-control {{ $errors->first('roles') ? "is-invalid":""}}">
                            <label for="CUSTOMER">CUSTOMER</label>
                        </div>
                        <div class="invalid-feedback">
                            {{ $errors->first('roles') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="tel" name="email" class="form-control" value="{{ $user->email }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="address">Address </label>
                        <textarea type="text" name="address" cols="30" rows="4"
                            class="form-control {{ $errors->first('address') ? "is-invalid":""}}">{{ old('address') ? old('address') : $user->address }}</textarea>
                            <div class="invalid-feedback">
                                {{ $errors->first('address') }}
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header pb-1 bg-transparent">
                    <label for="avatar">Avatar</label>
                </div>
                <div class="card-body">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="MA" srcset=""
                            width="120px" class="p-2">
                    @else
                        No Avatar
                    @endif
                    <input type="file" name="avatar" id="avatar" class="form-control">
                    <small class="text-danger">Kosongkan jika tidak ingin mengubah avatar</small>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
