@extends('layouts.global')
@section('title')
    Products List
@endsection
@section('content')
<div class="col-md-12">
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
        <div class="col-md-6">
            <form action="{{ route('products.index') }}">
                <div class="input-group mb-3">
                    <input type="text" name="keyword" id="keyword"
                        value="{{ Request::get('keyword') }}" class="form-control"
                        placeholder="Filter berdasarkan email">
                        <input type="hidden" name="status" value="{{ Request::get('status') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="nav-link {{ Request::get('status') == NULL && Request::path() == 'products' ? 'active' : '' }}" href="{{ route('products.index') }}">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::get('status') =='publish' ? 'active' : '' }}" href="{{ route('products.index', ['status'=>'publish']) }}">Publish</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::get('status') =='draft' ? 'active' : '' }}" href="{{ route('products.index', ['status'=>'draft']) }}">Draft</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() == 'products/trash' ? 'active' : '' }}" href="{{ route('products.trash') }}">Trash</a>
                </li>
            </ul>
        </div>
    </div>
    {{-- button add new categories --}}
    <div class="mb-2">
        <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-primary">
            <span class="oi oi-plus"></span>  Add Product</a>
    </div>

    {{-- table views categories --}}
    <div class="card">
        <div class="card-header bg-transparent">
            <h5>Product List</h5>
        </div>
        <div class="card-body table-responsive-sm">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $no=>$item)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>
                                @if($item->image)
                                    <img src="{{ asset('storage/'. $item->image) }}" alt="img"
                                        width="48px">
                                @endif
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>
                                @if ($item->status == "PUBLISH")
                                <span class="badge bg-success text-white">{{ $item->status }}</span>
                                @else
                                <span class="badge bg-dark text-white">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td>{{ $item->stock }}</td>
                            <td>{{ $item->price }}</td>
                            <td>
                                <a href="{{ route('products.edit', [$item->id]) }}"
                                    class="btn btn-sm btn-primary">
                                    <span class="oi oi-pencil"></a>
                                <a href="{{ route('categories.show', [$item->id]) }}"
                                    class="btn btn-sm btn-info">
                                    <span class="oi oi-eye"></a>
                                <form
                                    action="{{ route('products.destroy', [$item->id]) }}"
                                    method="post" class="d-inline" onsubmit="return confirm('Move Product to Trash?')">
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
                            {{ $products->appends(Request::all())->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection