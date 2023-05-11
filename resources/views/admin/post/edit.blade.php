@extends('layouts.master')


@section('title', 'Edit Post')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">

        <div class="card-header">
            <h4 class="fw-bold">Edit Posts
                <a href="{{ url('admin/posts') }}" class="btn btn-danger float-end">BACK</a>
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
            <form action="{{ url('admin/update-post/'.$post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="">Category </label>
                    @foreach ($category as $catitem)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="category_id[]" value="{{ $catitem->id }}" id="category_{{ $catitem->id }}" {{ $post->categories->contains($catitem->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="category_{{ $catitem->id }}">
                                {{ $catitem->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="mb-3">
                    <label for="">Title</label>
                    <input type="text" name="title" value="{{ $post->title }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Slug</label>
                    <input type="text" name="slug" value="{{ $post->slug }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Content</label>
                    <textarea type="text" name="content" id="mySummernote" rows="5" class="form-control">{!! $post->content !!}</textarea>
                </div>
                <div class="mb-3">
                    <label for="">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <h5 class="fw-bold">Meta Tags</h5>
                <div class="mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ $post->meta_title }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="form-control">{!! $post->meta_description !!}</textarea>
                </div>
                <div class="mb-3">
                    <label for="">Meta Keywords</label>
                    <textarea name="meta_keyword" rows="3" class="form-control">{!! $post->meta_keyword !!}</textarea>
                </div>

                <h5 class="fw-bold">Related Post</h5>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="related_post_id">Select Related Post</label>
                            <select class="form-control" name="related_post_id" id="related_post_id">
                                <option value="">-- Select --</option>
                                @foreach($posts as $postitem)
                                    <option value="{{ $postitem->id }}" {{ $post->relatedBlogPost ? 'selected' : '' }}>{{ $postitem->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold">Status</h5>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="">Hidden</label>
                        <input type="checkbox" name="status" {{ $post->status == '1' ? 'checked':'' }}>
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
