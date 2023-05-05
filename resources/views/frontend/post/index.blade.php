@extends('layouts.app')


@section('title', "$category->meta_title")
@section('meta_description', "$category->meta_description")
@section('meta_keyword', "$category->meta_keyword")

@section('content')

    <!-- Page Header-->
    <header class="masthead container" style="height:200px;background-image:linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.9)),url({{ asset('uploads/category/' . $category->image) }});
    background-repeat:repeat-x;background-size:300px">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading mt-5">
                        <h1 class="text-center" style="text-decoration:underline">{{ $category->name }}</h1>
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
                @forelse ($post as $postitem)
                    <div class="row">
                        <div class="col-md-8">
                            <a href="{{ url('section/' . $category->slug . '/' . $postitem->slug) }}">
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

                <div class="d-flex justify-content-center your-paginate">
                    {{ $post->links() }}
                </div>



            </div>
        </div>
    </div>
@endsection
