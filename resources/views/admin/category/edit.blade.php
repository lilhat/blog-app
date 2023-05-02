@extends('layouts.master')


@section('title', 'Category')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Category</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Category</li>
    </ol>
    <div class="row">
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h4 class="fw-bold">Edit Category</h4>
        </div>
        <div class="card-body">

            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            </div>
            @endif

            <form action="{{ url('admin/update-category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="">Category Name</label>
                    <input type="text" name="name" value="{{ $category->name }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Slug</label>
                    <input type="text" name="slug" value="{{ $category->slug }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Description</label>
                    <textarea type="text" name="description" rows="5" class="form-control">{{ $category->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <h5 class="fw-bold">Meta Tags</h5>
                <div class="mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ $category->meta_title }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="form-control">{{ $category->meta_description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="">Meta Keywords</label>
                    <textarea name="meta_keyword" rows="3" class="form-control">{{ $category->meta_keyword }}</textarea>
                </div>

                <h5 class="fw-bold">Status</h5>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="">Navbar Status</label>
                        <input type="checkbox" name="navbar_status" {{ $category->navbar_status == '1' ? 'checked':'' }}>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">Status</label>
                        <input type="checkbox" name="status" {{ $category->status == '1' ? 'checked':'' }}>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Save Category</button>
                    </div>
                </div>


            </form>
        </div>
</div>

@endsection
