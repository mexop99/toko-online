@extends('layouts.global')
@section('title')
Detail User
@endsection

@section('content')
<div class="col-lg-5 col-md-12 mb-2">
    <div class="card shadow-sm">
        <div class="card-header d-flex bg-primary border-0">
            <img class="w-25 h-25 rounded-circle"
                src="{{ asset('storage/' . $user->avatar) }}" alt="user">
            <div class="text-light ml-4">
                <h5 class="m-0">{{ $user->name }}</h5>
                <small>{{ $user->email }}</small>
            </div>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-lg-4">
                            Nama
                        </div>
                        <div class="col-lg-7">
                            {{ $user->name }}
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-lg-4">
                            Email
                        </div>
                        <div class="col-lg-7">
                            {{ $user->email }}
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-lg-4">
                            Address
                        </div>
                        <div class="col-lg-7">
                            {{ $user->address }}
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-lg-4">
                            Address
                        </div>
                        <div class="col-lg-7">
                            @foreach (json_decode($user->roles) as $role)
                            &minus; {{ $role }}
                            <br>
                            @endforeach
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-lg-4">
                            <a href="{{ route('users.index') }}" class="btn btn-warning btn-sm">Back</a>
                        </div>
                        <div class="col-lg-7">
                            
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
