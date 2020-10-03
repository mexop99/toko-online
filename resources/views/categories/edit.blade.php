@extends('layouts.global')

@section('titile')
Edit Category
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

    <form action="{{ route('categories.update', [$category->id]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="PUT" name="_method">
        <div class="card">
            <div class="card-header bg-white pb-2">
                <h5>Edit Category</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-3">Nama Categori</label>
                    <div class="col-sm-9">
                        <input type="text"
                            class="form-control {{ $errors->first('name') ? "is-invalid":"" }}"
                            name="name"
                            value="{{ old('name') ? old('name') : $category->name }}">
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3">Slug Categori</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="slug" value="{{ $category->slug }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3">Current Image</label>
                    <div class="col-sm-9">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt=""
                                width="120px">
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-3">Category Gambar</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="image">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">
                    <span class="oi oi-check"></span> Save</button>
                <a href="{{ route('categories.index') }}" class="btn btn-sm btn-danger"><span
                        class="oi oi-x"></span> Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
