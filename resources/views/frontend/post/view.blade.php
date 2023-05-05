@extends('layouts.app')

@section('title', "$post->meta_title")
@section('meta_description', "$post->meta_description")
@section('meta_keyword', "$post->meta_keyword")

@section('content')

    <!-- Main Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="mt-3">
                <h6 class="text-center">
                    <a href="/section/{{ $category->slug }}" class="text-decoration-none" style="color:black;">{{ $post->category->name }}</a>
                     /
                    <span style="opacity:20%;">{{$post->title }}</span>
                </h6>
            </div>
            <div class="site-heading mb-4">
                <h1 class="text-center" style="text-decoration:underline">{!! $post->title !!}</h1>
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center mb-4">
                <img src="{{ asset('uploads/post/' . $post->image) }}" class="post-image">
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="card p-3 text-center">
                        <div class="card-body post-description">
                            {!! $post->content !!}
                            <p class="post-meta">
                                Posted by
                                <a href="">{{ $post->user->name }}</a>
                                on {{ $post->created_at->format('d-m-Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <div class="py-4 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h4>Latest Posts</h4>
                    </div>
                    <hr class="my-4"/>
                </div>
                @foreach ($latest_posts as $latest_post_item)
                    <div class="col-md-3">
                        <div class="card card-head p-3" style="height:130px;">
                            <a href="{{ url('section/'.$latest_post_item->category->slug.'/'.$latest_post_item->slug) }}" class="text-decoration-none">
                                <h6 class="extra-title"  style="height:35px;">{{ $latest_post_item->title }}</h6>
                            </a>
                            <a class="text-dark text-decoration-none" href="{{ url('section/'.$latest_post_item->category->slug) }}"><p class="extra-cat">{{ $latest_post_item->category->name }}</p></a>
                            <p class="post-meta">
                                Posted by
                                <a href="">{{ $latest_post_item->user->name }}</a>
                                on {{ $latest_post_item->created_at->format('d-m-Y') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
