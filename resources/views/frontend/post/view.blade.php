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
                    <a href="/section/{{ $category->slug }}" class="text-decoration-none"
                        style="color:black;">{{ $post->category->name }}</a>
                    /
                    <span style="opacity:20%;">{{ $post->title }}</span>
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
                    <div class="card p-3 shadow-sm text-center">
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
                <hr class="mt-4">

                <section class="comment-section">
                    @auth
                        <!-- Add comment -->
                        <div class="container mt-5 my-3 py-3">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-12 col-lg-10 col-xl-8">
                                    <div class="card">
                                        <div class="card-body shadow-sm">
                                            <form action="" method="POST">
                                                @csrf
                                                <div class="d-flex flex-start w-100">
                                                    <div class="form-outline w-100">
                                                        <input type="hidden" value="{{ $post->id }}" name="post_id"
                                                            id="post_id">
                                                        <textarea class="form-control bg-white" id="comment" placeholder="Add a comment..." id="textAreaExample"
                                                            rows="4"></textarea>
                                                    </div>
                                                </div>
                                                <div class="float-end mt-2 pt-1">
                                                    <button type="button" id="addCommentBtn"
                                                        class="btn btn-primary btn-sm">Post comment</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card align-items-center m-auto p-3 shadow-sm" style="width:fit-content;">
                            <h5 class="text-center">Must be logged in to comment</h5>
                            <div class="card-body text-center">
                                <a href="{{ route('login') }}" class="nav-link text-white btn btn-warning"
                                    style="width:75px;">Log in</a>
                                OR
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="nav-link text-white btn btn-warning"
                                        style="width:75px;">Register</a>
                                @endif
                            </div>
                        </div>
                    @endauth
                    <!-- Display comments -->
                    <div class="container my-3 py-3">
                        <div class="comments row d-flex justify-content-center">
                            @forelse ($post->comments->reverse() as $comment)
                                <div class="comment-container col-md-12 col-lg-10 col-xl-8">
                                    <hr class="mt-4">
                                    <div>
                                        <div class="d-flex flex-start justify-content-between">
                                            <div>
                                                <h6 class="fw-bold text-primary mb-1">{{ $comment->user->name }}</h6>
                                                <p class="text-muted small mb-0">
                                                    {{ $comment->posted_at }}
                                                </p>
                                            </div>
                                            @if (Auth::check() && Auth::id() == $comment->user_id)
                                                <div>
                                                    <button id="editCommentBtn" class="btn btn-primary">Edit</button>
                                                    <button id="deleteCommentBtn" value="{{ $comment->id }}"
                                                        class="btn btn-danger">Delete</button>
                                                </div>
                                            @endif
                                        </div>

                                        <p class="mt-3 mb-4 pb-2" id="display-comment">
                                            {{ $comment->content }}
                                        </p>

                                        <div class="small d-flex justify-content-start">
                                            <a href="#!" class="d-flex align-items-center me-3">
                                                <i class="far fa-thumbs-up me-2"></i>
                                                <p class="mb-0">Like</p>
                                            </a>
                                            <a href="#!" class="d-flex align-items-center me-3">
                                                <i class="far fa-comment-dots me-2"></i>
                                                <p class="mb-0">Reply</p>
                                            </a>
                                            <a href="#!" class="d-flex align-items-center me-3">
                                                <i class="fas fa-share me-2"></i>
                                                <p class="mb-0">Share</p>
                                            </a>
                                        </div>
                                        <hr class="mt-4">
                                        <div class="reply"  style="width:80%;margin-left:20%!important;">
                                            <div class="d-flex mt-4 justify-content-between">
                                                <div>
                                                    <h6 class="fw-bold text-primary mb-1">{{ $comment->user->name }}</h6>
                                                    <p class="text-muted small mb-0">
                                                        {{ $comment->posted_at }}
                                                    </p>
                                                </div>
                                                @if (Auth::check() && Auth::id() == $comment->user_id)
                                                    <div>
                                                        <button id="editCommentBtn" class="btn btn-primary">Edit</button>
                                                        <button id="deleteCommentBtn" value="{{ $comment->id }}"
                                                            class="btn btn-danger">Delete</button>
                                                    </div>
                                                @endif
                                            </div>

                                            <p class="mt-3 mb-4 pb-2" id="display-comment">
                                                {{ $comment->content }}
                                            </p>

                                            <div class="small d-flex justify-content-start">
                                                <a href="#!" class="d-flex align-items-center me-3">
                                                    <i class="far fa-thumbs-up me-2"></i>
                                                    <p class="mb-0">Like</p>
                                                </a>
                                                <a href="#!" class="d-flex align-items-center me-3">
                                                    <i class="far fa-comment-dots me-2"></i>
                                                    <p class="mb-0">Reply</p>
                                                </a>
                                                <a href="#!" class="d-flex align-items-center me-3">
                                                    <i class="fas fa-share me-2"></i>
                                                    <p class="mb-0">Share</p>
                                                </a>
                                            </div>
                                            <hr class="mt-4">
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="no-comments text-center">No Comments Yet</p>
                            @endforelse
                        </div>
                    </div>
            </div>
            </section>
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
                    <hr class="my-4" />
                </div>
                @foreach ($latest_posts as $latest_post_item)
                    <div class="col-md-3">
                        <div class="card card-head p-3" style="height:130px;">
                            <a href="{{ url('section/' . $latest_post_item->category->slug . '/' . $latest_post_item->slug) }}"
                                class="text-decoration-none">
                                <h6 class="extra-title" style="height:35px;">{{ $latest_post_item->title }}</h6>
                            </a>
                            <a class="text-dark text-decoration-none"
                                href="{{ url('section/' . $latest_post_item->category->slug) }}">
                                <p class="extra-cat">{{ $latest_post_item->category->name }}</p>
                            </a>
                            <p class="post-meta">
                                Posted by
                                <a href="">{{ $latest_post_item->user->name }}</a>
                                on {{ $latest_post_item->created_at->format('d-m-Y') }}
                            </p>
                        </div>
                    </div>
                @endforeach
                <div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.4.min.js') }}"></script>
    @auth
        <script>
            // Add comment by id

            $('#addCommentBtn').on('click', function() {

                var comment = $('#comment').val();
                var post_id = $('#post_id').val();
                var vm = $(this);
                window.currentUser = "{{ Auth::user()->name }}";

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        blog_post_id: post_id,
                        content: comment,
                        _token: '{{ csrf_token() }}'
                    },
                    url: "{{ url('add-comment') }}",
                    beforeSend: function() {
                        vm.text('Saving...').addClass('disabled');
                    },
                    success: function(res) {
                        var _html = `<div class="comment-container col-md-12 col-lg-10 col-xl-8">
                                            <hr class="mt-4">
                                            <div>
                                                <div class="d-flex flex-start justify-content-between">
                                                    <div>
                                                        <h6 class="fw-bold text-primary mb-1">` + window.currentUser + `</h6>
                                                        <p class="text-muted small mb-0">` + res.posted_at + `</p>
                                                    </div>
                                                    @if (Auth::check())
                                                        <div>
                                                            <button id="editCommentBtn" class="btn btn-primary">Edit</button>
                                                            <button id="deleteCommentBtn" value="` + res.id + `"
                                                                class="btn btn-danger">Delete</button>
                                                        </div>
                                                    @endif
                                                </div>
                                                <p class="mt-3 mb-4 pb-2" id="display-comment">` + res.content + `</p>
                                                <div class="small d-flex justify-content-start">
                                                    <a href="#!" class="d-flex align-items-center me-3">
                                                        <i class="far fa-thumbs-up me-2"></i>
                                                        <p class="mb-0">Like</p>
                                                    </a>
                                                    <a href="#!" class="d-flex align-items-center me-3">
                                                        <i class="far fa-comment-dots me-2"></i>
                                                        <p class="mb-0">Comment</p>
                                                    </a>
                                                    <a href="#!" class="d-flex align-items-center me-3">
                                                        <i class="fas fa-share me-2"></i>
                                                        <p class="mb-0">Share</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <hr class="mt-4">
                                    </div>`;
                        if (res) {
                            $(".comments").prepend(_html);
                            $("#comment").val('');
                            $(".no-comments").hide();
                        }
                        vm.text('Post Comment').removeClass('disabled');
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {

                $(document).on('click', '#deleteCommentBtn', function() {

                    if (confirm('Are you sure you want to delete this comment?')) {
                        var thisClicked = $(this);
                        var comment_id = thisClicked.val();


                        $.ajax({
                            type: 'POST',
                            data: {
                                comment_id: comment_id,
                                _token: '{{ csrf_token() }}'
                            },
                            url: "{{ url('delete-comment') }}",
                            success: function(res) {
                                if (res.status == 200) {
                                    thisClicked.closest('.comment-container').remove();
                                    alert(res.message);
                                } else {
                                    alert(res.message);
                                }
                            }



                        });
                    }
                });
            });
        </script>
    @endauth
@endsection
