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
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="title" placeholder="tuliskan nama product..."
                            name="title">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                        <textarea type="text" class="form-control" id="description"
                            placeholder="tuliskan deksripsi product..." name="description" rows="10"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="categories" class="col-sm-3 col-form-label">Category</label>
                    <div class="col-sm-9">
                        <select name="categories[]" id="categories" class="form-control" multiple></select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stock" class="col-sm-3 col-form-label">Stock</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="stock" placeholder="exp: 100" name="stock">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-sm-3 col-form-label">Price</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="price" placeholder="exp: 100000" name="price">
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
