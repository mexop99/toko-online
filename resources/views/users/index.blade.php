@extends('layouts.global')

@section('title')
Users List
@endsection

@section('pageTitle')
User List
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

<div class="col-lg-12 pl-3">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('users.index') }}">
                <div class="input-group mb-3">
                    <input type="text" name="keyword" id="keyword"
                        value="{{ Request::get('keyword') }}" class="form-control col-md-10"
                        placeholder="Filter berdasarkan email">
                    <div class="col-md-2">
                        <input type="radio" name="status" id="active" value="ACTIVE"
                            {{ Request::get('status') == 'ACTIVE' ? 'checked' : '' }}>
                        <label for="active">ACTIVE</label>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" name="status" id="inactive" value="INACTIVE"
                            {{ Request::get('status') == 'INACTIVE' ? 'checked' : '' }}>
                        <label for="inactive">INACTIVE</label>
                    </div>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="mb-2">
        <a href="{{ route('users.create') }}" class="btn btn-sm btn-outline-primary">
            <span class="oi oi-plus"></span> Create User</a>
    </div>
    <table class="table table-hover">
        <thead class="border-0">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">username</th>
                <th scope="col">Email</th>
                {{-- <th scope="col">Avatar</th> --}}
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $no => $item)
                <tr>
                    <th>{{ ++$no }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->email }}</td>
                    {{-- <td>
                        @if($item->avatar)
                            <img src="{{ asset('storage/'. $item->avatar) }}"
                                alt="{{ $item->avatar }}" width="70px">
                        @else
                            N/A
                        @endif
                    </td> --}}
                    <td>
                        @if($item->status == 'ACTIVE')
                            <span class="badge badge-success">
                                {{ $item->status }}
                            </span>
                        @else
                            <span class="badge badge-danger">
                                {{ $item->status }}
                            </span>
                        @endif
                    </td>
                    <td>
                        <div class="d-inline-flex">
                            <a class="btn btn-sm btn-primary d-block m-2"
                                href="{{ route('users.edit', [$item->id]) }}">
                                <span class="oi oi-pencil"></span></a>
                            <form class="m-2 d-block"
                                action="{{ route('users.destroy', [$item->id]) }}"
                                method="post" onsubmit="return confirm('Delete this User Permanently?')">
                                @csrf

                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm ">
                                    <span class="oi oi-trash"></span></button>

                            </form>
                            <a class="btn btn-sm btn-info m-2 d-block "
                                href="{{ route('users.show', [$item->id]) }}">
                                <span class="oi oi-eye"></span></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="10">
                    {{ $users->appends(Request::all())->links() }}
                </td>
            </tr>
        </tfoot>
    </table>
</div>

@endsection
