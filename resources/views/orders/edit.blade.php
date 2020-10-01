@extends('layouts.global')
@section('title')
Edit Order
@endsection

@section('content')
<div class="col-md-8">
    {{-- alert --}}
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- form edit data product --}}
    <form action="{{ route('orders.update', [$order->id]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="PUT" name="_method">
        <div class="card">
            <div class="card-header bg-white pb-2">
                <h3 class="text text-primary text">{{ $order->invoice_number }}</h3>
                <small class="text text-muted">invoice number</small>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="buyer" class="col-sm-3">Buyer</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="buyer" id="buyer" value="{{ $order->user->name }}" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="created_at" class="col-sm-3">Order Date</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="created_at" value="{{ $order->created_at }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="total_price" class="col-sm-3">Total Price</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="total_price" value="{{ $order->total_price }}" disabled>
                    </div>
                </div>

                <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Total Price</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $no=>$item)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->pivot->quantity }}</td>
                                    @php
                                        $total_price = $item->pivot->quantity * $item->price
                                    @endphp
                                    <td>{{ $total_price }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">Grand Total</td>
                                    <td>{{ $order->total_price }}</td>
                                </tr>
                            </tbody>
                        </table>
                </div>

                <div class="form-group row">
                    <label for="status" class="col-sm-3">Status</label>
                    <div class="col-sm-9">
                        <select name="status" id="status" class="form-control">
                            <option {{ $order->status == "SUBMIT" ? "selected":"" }} value="SUBMIT">SUBMIT</option>
                            <option {{ $order->status == "PROCESS" ? "selected":"" }} value="PROCESS">PROCESS</option>
                            <option {{ $order->status == "DELIVERY" ? "selected":"" }} value="DELIVERY">DELIVERY</option>
                            <option {{ $order->status == "RECEIVED" ? "selected":"" }} value="RECEIVED">RECEIVED</option>
                            <option {{ $order->status == "FINISH" ? "selected":"" }} value="FINISH">FINISH</option>
                            <option {{ $order->status == "CANCEL" ? "selected":"" }} value="CANCEL">CANCEL</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">
                    <span class="oi oi-check"></span> Save</button>
            </div>
        </div>
    </form>
</div>
@endsection
