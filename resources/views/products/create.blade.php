@extends('layouts.global')
@section('title')
Create Product
@endsection

@section('content')
<div class="col-lg-9 p-3">
    {{-- alert --}}
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-header">
            <h5>Create Product</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="image" class="col-sm-3 col-form-label">Image</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control {{ $errors->first('image') ? "is-invalid":"" }}" id="image" name="image">
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-9">
                        <input value="{{ old('title') }}" type="text" class="form-control {{ $errors->first('title') ? "is-invalid":"" }}" id="title" placeholder="tuliskan nama product..."
                            name="title" value="{{ old('title') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                        <textarea type="text" class="form-control {{ $errors->first('description') ? "is-invalid":"" }}" id="description"
                            placeholder="tuliskan deksripsi product..." name="description" rows="10">{{ old('description') }}</textarea>
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="categories" class="col-sm-3 col-form-label">Category</label>
                    <div class="col-sm-9">
                        <select name="categories[]" id="categories" class="form-control {{ $errors->first('categories') ? "is-invalid":"" }}" multiple></select>
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stock" class="col-sm-3 col-form-label">Stock</label>
                    <div class="col-sm-9">
                        <input value="{{ old('stock') }}" type="number" class="form-control {{ $errors->first('stock') ? "is-invalid":"" }}" id="stock" placeholder="exp: 100" name="stock">
                        <div class="invalid-feedback">
                            {{ $errors->first('stock') }}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-sm-3 col-form-label">Price</label>
                    <div class="col-sm-9">
                        <input value="{{ old('price') }}" type="number" class="form-control {{ $errors->first('price') ? "is-invalid":"" }}" id="price" placeholder="exp: 100000" name="price">
                        <div class="invalid-feedback">
                            {{ $errors->first('price') }}
                        </div>
                    </div>
                </div>

                <button class="btn btn-sm btn-primary" name="save_action" value="PUBLISH">Publish</button>
                <button class="btn btn-sm btn-danger" name="save_action" value="DRAFT">Save a Draft</button>
            </form>
        </div>
    </div>
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

</script>
@endsection
