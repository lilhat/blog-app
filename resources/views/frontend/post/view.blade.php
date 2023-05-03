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
                    <div class="card p-3">
                        {!! $post->content !!}
                        <p class="post-meta text-center">
                            Posted by
                            <a href="">{{ $post->user->name }}</a>
                            on {{ $post->created_at->format('d-m-Y') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-4">
                    <div class="card mt-3">
                        <div class="card-header">
                            <h4>Latest Posts</h4>
                        </div>
                        <div class="card-body">
                            @foreach ($latest_posts as $latest_post)
                                <a href="{{ url('section/'.$latest_post->category->slug.'/'.$latest_post->slug) }}" class="text-decoration-none">
                                    <h6>{{ $latest_post->title }}</h6>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <!-- Footer-->
    <footer class="border-top">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <ul class="list-inline text-center">
                        <li class="list-inline-item">
                            <a href="#!">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2023</div>
                </div>
            </div>
        </div>
    </footer>
@endsection
