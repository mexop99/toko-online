@extends('layouts.global')
@section('title')
Order List
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

    {{-- filter pencarian --}}
    <form action="{{ route('orders.index') }}">
        <div class="row mb-2">
            <div class="input-group col-md-5">
                <input type="text" name="keyword" id="keyword"
                    value="{{ Request::get('keyword') }}" class="form-control"
                    placeholder="Filter berdasarkan email">
                {{-- <input type="hidden" name="status" value="{{ Request::get('status') }}"> --}}
            </div>
            <div class="input-group col-md-2">
                <select name="status" id="status" class="form-control mr-2 ml-2">
                    <option value="">ANY</option>
                    <option
                        {{ Request::get('status') == "SUBMIT" ? "selected" : "" }}
                        value="SUBMIT">SUBMIT</option>
                    <option
                        {{ Request::get('status') == "PROCESS" ? "selected" : "" }}
                        value="PROCESS">PROCESS</option>
                    <option
                        {{ Request::get('status') == "DELIVERY" ? "selected" : "" }}
                        value="DELIVERY">DELIVERY</option>
                    <option
                        {{ Request::get('status') == "RECEIVED" ? "selected" : "" }}
                        value="RECEIVED">RECEIVED</option>
                    <option
                        {{ Request::get('status') == "FINISH" ? "selected" : "" }}
                        value="FINISH">FINISH</option>
                    <option
                        {{ Request::get('status') == "CANCEL" ? "selected" : "" }}
                        value="CANCEL">CANCEL</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-md">Filter</button>
            </div>
        </div>
    </form>


    <div class="mb-2">
        <a href="#" class="btn btn-sm btn-outline-primary">
            <span class="oi oi-plus"></span> Add</a>
    </div>

    {{-- table views categories --}}
    <div class="card">
        <div class="card-header bg-transparent">
            <h5>Order List</h5>
        </div>
        <div class="card-body table-responsive-sm">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Invoice Number</th>
                        <th>Status</th>
                        <th>Buyer</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Order Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $no=>$item)
                        <tr>
                            <td>{{ $item->invoice_number }}</td>
                            <td>
                                @if($item->status == 'SUBMIT')
                                    <span class="badge bg-primary text-white">{{ $item->status }}</span>
                                @elseif($item->status == 'PROCESS')
                                    <span class="badge bg-warning">{{ $item->status }}</span>
                                @elseif($item->status == 'DELIVERY')
                                    <span class="badge bg-info text-white">{{ $item->status }}</span>
                                @elseif($item->status == 'RECEIVED')
                                    <span class="badge bg-info-darkest text-white">{{ $item->status }}</span>
                                @elseif($item->status == 'FINISH')
                                    <span class="badge bg-success text-white">{{ $item->status }}</span>
                                @else
                                    <span class="badge bg-danger text-white">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->totalQuantity }} pc (s)</td>
                            <td>{{ $item->total_price }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="{{ route('orders.edit', [$item->id]) }}"
                                    class="btn btn-sm btn-primary">
                                    <span class="oi oi-pencil"></a>
                                <a href="#" class="btn btn-sm btn-info">
                                    <span class="oi oi-eye"></a>
                                <form action="#" method="post" class="d-inline"
                                    onsubmit="return confirm('Move Product to Trash?')">
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
                            {{ $orders->appends(Request::all())->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
