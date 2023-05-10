@extends('layouts.app')


@section('title', "$user->name")
{{-- @section('meta_description', "$category->meta_description")
@section('meta_keyword', "$category->meta_keyword") --}}

@section('content')

    <!-- Page Header-->
    <header class="masthead container">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading mt-5">
                        <h1 class="text-center" style="text-decoration:underline">{{ $user->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <!-- Post preview-->
                <h3 class="text-center opacity-50 py-2" style="text-decoration:underline">Blog Posts</h3>
                @forelse ($post as $postitem)
                    <div class="row">
                        <div class="col-md-8">
                            <a href="{{ url('section/' . $postitem->category->slug . '/' . $postitem->slug) }}">
                                <h3 class="post-title mt-4">{{ $postitem->title }}</h3>
                            </a>
                            <h6 class="post-content" style="max-lines:3;">{{ strip_tags($postitem->content) }}</h6>
                            <p class="post-meta">
                                Posted by
                                <a href="">{{ $postitem->user->name }}</a>
                                on {{ $postitem->created_at->format('d-m-Y') }}
                            </p>

                        </div>
                        <div class="col-md-3 text-center m-auto">
                            <img src="{{ asset('uploads/post/' . $postitem->image) }}" class="post-thumb">
                        </div>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4"/>

                @empty
                    <div class="card card-shadow mt-4 mb-4">
                        <div class="card-body">
                            <h1>No Posts Found</h1>
                        </div>
                    </div>
                @endforelse



            </div>
        </div>
    </div>

    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <!-- Post preview-->
                <h3 class="text-center opacity-50 py-2" style="text-decoration:underline">Comments</h3>
                @forelse ($comment->paginate(5) as $commentitem)
                    <div class="row">
                        <div class="col-md-8">
                            <a href="{{ url('section/' . $commentitem->blogPost->category->slug . '/' . $commentitem->blogPost->slug) }}">
                                <h5 class="post-title">{{ $commentitem->blogPost->title }}</h5>
                            </a>
                            @if($commentitem->parent_id > 0)
                                <h6 class="opacity-50">Replying to: <a href="">{{ $commentitem->parentComment->user->name }}</a></h6>
                            @endif
                            <h6 class="post-content" style="max-lines:3;">{{ strip_tags($commentitem->content) }}</h6>
                            <p class="post-meta">
                                Posted by
                                <a href="">{{ $commentitem->user->name }}</a>
                                on {{ $commentitem->created_at }}
                            </p>

                        </div>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4"/>

                @empty
                    <div class="card card-shadow mt-4 mb-4">
                        <div class="card-body">
                            <h1>No Posts Found</h1>
                        </div>
                    </div>
                @endforelse

                <div class="m-auto" style="position: relative;left:38%">
                    <div class="comment-pagination mt-4 text-center">
                        {{ $comment->paginate(5)->withQueryString()->links('pagination::simple-bootstrap-5') }}
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
