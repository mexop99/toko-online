@extends('layouts.global')
@section('title')
Create Category
@endsection

@section('content')

<div class="col-lg-9">    
    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data"
        class="p-3">
        @csrf
        <div class="card">
            <div class="card-header bg-white pb-2">
                <h5>Create Category</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-3">Nama Categori</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control {{ $errors->first('name') ? "is-invalid":""}}" name="name">
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3">Category Gambar</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control {{ $errors->first('image') ? "is-invalid":""}}" name="image">
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">
                    <span class="oi oi-check"></span> Save</button>
            </div>
        </div>
    </form>
</div>

@endsection
