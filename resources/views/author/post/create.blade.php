@extends('layouts.master')


@section('title', 'Add Post')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">

        <div class="card-header">
            <h4 class="fw-bold">Add Posts
                <a href="{{ url('author/add-post') }}" class="btn btn-primary float-end">Add Posts</a>
            </h4>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            </div>
        @endif


        <div class="card-body">
            <form action="{{ url('author/add-post') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="">Category </label>
                    @foreach ($category as $catitem)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="category_id[]" value="{{ $catitem->id }}" id="category_{{ $catitem->id }}">
                            <label class="form-check-label" for="category_{{ $catitem->id }}">
                                {{ $catitem->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="mb-3">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Slug</label>
                    <input type="text" name="slug" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Content</label>
                    <textarea type="text" name="content" id="mySummernote" rows="5" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="">Image</label>
                    <input type="file" name="image" required class="form-control">
                </div>

                <h5 class="fw-bold">Meta Tags</h5>
                <div class="mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="">Meta Keywords</label>
                    <textarea name="meta_keyword" rows="3" class="form-control"></textarea>
                </div>

                <h5 class="fw-bold">Related Post</h5>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="related_post_id">Select Related Post</label>
                            <select class="form-control" name="related_post_id" id="related_post_id">
                                <option value="">-- Select --</option>
                                @foreach($posts as $post)
                                    <option value="{{ $post->id }}">{{ $post->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold">Status</h5>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="">Hidden</label>
                        <input type="checkbox" name="status">
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Save Post</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
