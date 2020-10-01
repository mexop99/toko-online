@extends('layouts.global')

@section('titile')
Edit Product
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
    <form action="{{ route('products.update', [$product->id]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="PUT" name="_method">
        <div class="card">
            <div class="card-header bg-white pb-2">
                <h5>Edit Product</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="image" class="col-sm-3">Current Image</label>
                    <div class="col-sm-9">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt=""
                                width="120px">
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-sm-3">Product Gambar</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="image" id="image">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-sm-3">Title</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="title" value="{{ $product->title }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="slug" class="col-sm-3">Slug Product</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="slug" value="{{ $product->slug }}" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-3">Descriptions</label>
                    <div class="col-sm-9">
                        <textarea name="description" id="description" cols="30" rows="10"
                            class="form-control">{{ $product->description }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="categories" class="col-sm-3">Categories</label>
                    <div class="col-sm-9">
                        <select name="categories[]" id="categories" class="form-control" multiple></select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="stock" class="col-sm-3">Stock</label>
                    <div class="col-sm-9">
                        <input type="number" name="stock" id="stock" class="form-control"
                            value="{{ $product->stock }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="price" class="col-sm-3">Price</label>
                    <div class="col-sm-9">
                        <input type="number" name="price" id="price" class="form-control"
                            value="{{ $product->price }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="status" class="col-sm-3">Status</label>
                    <div class="col-sm-9">
                        <select name="status" id="status" class="form-control">
                            <option {{ $product->status == 'PUBLISH'?'selected':'' }} value="PUBLISH">PUBLISH</option>
                            <option {{ $product->status == 'DRAFT'?'selected':'' }} value="DRAFT">DRAFT</option>
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

@section('footer-script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    $('#categories').select2({
        ajax: {
            url: 'http://localhost:8000/ajax/categories/search',
            processResults: function (data) {
                return {
                    results: data.map(function (item) {
                        return {
                            id: item.id,
                            text: item.name
                        }
                    })
                }
            }
        }
    });

    var categories = {!!$product->categories!!}

    categories.forEach(function(category) {
        var option = new Option(category.name, category.id, true, true);
        $('#categories').append(option).trigger('change');
    });
</script>
@endsection
