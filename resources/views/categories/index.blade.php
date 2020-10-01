@extends('layouts.global')
@section('title')
Categoy List
@endsection

@section('content')
<div class="col-md-9">
    {{-- alert --}}
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <div class="row">
        {{-- filter pencarian --}}
        <div class="col-md-9">
            <form action="{{ route('categories.index') }}">
                <div class="input-group mb-3">
                    <input type="text" name="keyword" id="keyword"
                        value="{{ Request::get('keyword') }}" class="form-control"
                        placeholder="Filter berdasarkan email">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('categories.index') }}">Published</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories.trash') }}">Trash</a>
                </li>
            </ul>
        </div>

        {{-- button add new categories --}}
        <div class="col-md-3 mb-2">
            <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary">
                <span class="oi oi-plus"></span> Create Category</a>
        </div>
    </div>

    {{-- table views categories --}}
    <div class="card">
        <div class="card-header bg-transparent">
            <h5>Categoy List</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $no=>$item)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>
                                @if($item->image)
                                    <img src="{{ asset('storage/'. $item->image) }}" alt="img"
                                        width="48px">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', [$item->id]) }}"
                                    class="btn btn-sm btn-primary">
                                    <span class="oi oi-pencil"></a>
                                <a href="{{ route('categories.show', [$item->id]) }}"
                                    class="btn btn-sm btn-info">
                                    <span class="oi oi-eye"></a>
                                <form
                                    action="{{ route('categories.destroy', [$item->id]) }}"
                                    method="post" class="d-inline" onsubmit="return confirm('Move Category to Trash?')">
                                    @csrf
                                    <input type="hidden" value="DELETE" name="_method">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <span class="oi oi-trash"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="10">
                            {{ $categories->appends(Request::all())->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>

</div>
@endsection
