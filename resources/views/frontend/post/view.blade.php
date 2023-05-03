@extends('layouts.app')

@section('content')

    <!-- Page Header-->
    <header class="masthead container">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <img src="{{ asset('uploads/post/' . $post->image) }}">
            </div>
        </div>
    </header>

    <!-- Main Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="mt-3">
                <h6 class="text-center">{{ $post->category->name . ' / ' . $post->title }}</h6>
            </div>
            <div class="site-heading mb-4">
                <h1 class="text-center" style="text-decoration:underline">{!! $post->title !!}</h1>
            </div>

            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    {!! $post->content !!}
                    <p class="post-meta text-center">
                        Posted by
                        <a href="">{{ $post->user->name }}</a>
                        on {{ $post->created_at->format('d-m-Y') }}
                    </p>
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
