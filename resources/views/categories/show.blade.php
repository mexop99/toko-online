@extends('layouts.global')

@section('titile')
Detail Category
@endsection

@section('content')
<div class="col-md-8">
    <div class="card shadow-sm">
        <div class="card-header bg-white pb-2">
            <h5>Detail Category</h5>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-3">Nama Categori</label>
                <div class="col-sm-9">
                    {{ $category->name }}
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-3">Slug Categori</label>
                <div class="col-sm-9">
                    {{ $category->slug }}
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-3">Current Image</label>
                <div class="col-sm-5">
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt=""
                            width="120px" class="border">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
