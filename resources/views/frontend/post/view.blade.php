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
                    <a href="/section/{{ $category->slug }}" class="text-decoration-none" style="color:black;">
                        {{ $category->name }}
                    </a>
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
                                <a href="{{ url('user/' . $post->user->id) }}">{{ $post->user->name }}</a>
                                on {{ $post->created_at->format('d-m-Y') }}
                            </p>
                        </div>
                        @if ($related_post)
                            <div class="card-footer">
                                <h6>Related Post</h6>
                                <a
                                    href="{{ url('section/' . $related_post->categories->first()->slug . '/' . $related_post->slug) }}">
                                    <p>{{ $related_post->title }}</p>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <hr class="mt-4">

                <section class="comment-section">
                    <h3 class="text-center comment-header">Comments</h3>
                    <div class="alert-container"></div>
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
                                                        <textarea class="form-control bg-white" id="comment" placeholder="Add a comment..." rows="4"></textarea>
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
                            @forelse ($post->comments()->where('parent_id', 0)->latest()->paginate(3) as $comment)
                                <div class="comment-container col-md-12 col-lg-10 col-xl-8">
                                    <hr class="mt-4">
                                    <div>
                                        <div class="d-flex flex-start justify-content-between comment-main">
                                            <div>
                                                <a href="{{ url('user/' . $comment->user->id) }}">
                                                    <h6 class="fw-bold text-primary mb-1">{{ $comment->user->name }}</h6>
                                                </a>
                                                <p class="text-muted small mb-0">
                                                    {{ $comment->posted_at }}
                                                </p>
                                            </div>
                                            @if ((Auth::check() && Auth::id() == $comment->user_id) || Auth::id() == '1')
                                                <div>
                                                    <input type="hidden" value="{{ $comment->content }}"
                                                        name="comment_content" id="comment_content">
                                                    <button id="editCommentBtn" class="btn btn-primary editCommentBtn"
                                                        value="{{ $comment->id }}">Edit</button>
                                                    <button id="deleteCommentBtn" value="{{ $comment->id }}"
                                                        class="btn btn-danger">Delete</button>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="comment-area" val="{{ $comment->content }}">
                                            <p class="mt-3 mb-4 pb-2" id="display-comment">
                                                {{ $comment->content }}
                                            </p>
                                        </div>

                                        <div class="small d-flex justify-content-start">
                                            <div class="d-flex align-items-center">
                                                <h5 class="like-count p-2 mt-2">{{ count($comment->likes) }}</h5>
                                                <form action="" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $post->id }}" name="post_id"
                                                        id="post_id">
                                                    @if ($comment->likes)
                                                        @php $liked = false; @endphp
                                                        @foreach ($comment->likes as $like)
                                                            @if ($like->user_id == Auth::id())
                                                                <div class="like-container">
                                                                    <button type="button"
                                                                        class="d-flex btn btn-primary rounded align-items-center me-3 likedCommentBtn"
                                                                        value="{{ $comment->id }}">
                                                                        <i class="far fa-thumbs-up me-2"></i>
                                                                        <p class="mb-0">Liked</p>
                                                                    </button>
                                                                </div>
                                                                @php $liked = true; @endphp
                                                            @break
                                                        @endif
                                                    @endforeach
                                                    @if (!$liked)
                                                        <div class="like-container">
                                                            <button type="button"
                                                                class="d-flex btn btn-primary rounded align-items-center me-3 likeCommentBtn"
                                                                value="{{ $comment->id }}">
                                                                <i class="far fa-thumbs-up me-2"></i>
                                                                <p class="mb-0">Like</p>
                                                            </button>
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="like-container">
                                                        <button type="button"
                                                            class="d-flex btn btn-primary rounded align-items-center me-3 likeCommentBtn"
                                                            value="{{ $comment->id }}">
                                                            <i class="far fa-thumbs-up me-2"></i>
                                                            <p class="mb-0">Like</p>
                                                        </button>
                                                    </div>
                                                @endif
                                            </form>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <button
                                                class="d-flex btn btn-primary rounded align-items-center me-3 replyCommentBtn"
                                                value="{{ $comment->id }}">
                                                <i class="far fa-comment-dots me-2"></i>
                                                <p class="mb-0">Reply</p>
                                            </button>
                                        </div>
                                    </div>

                                    <hr class="mt-4 comment-bottom">

                                    <div class="alert-container-reply"></div>
                                    <!-- REPLIES -->
                                    <div class="container">
                                        <div class="reply-section"></div>
                                    </div>

                                    <div class="reply-container">
                                        @foreach ($comment->replies as $reply)
                                            <div class="comment-container">
                                                <div class="reply" style="width:80%;margin-left:20%!important;">
                                                    <div class="d-flex mt-4 justify-content-between comment-main">
                                                        <div>
                                                            <a href="{{ url('user/' . $comment->user->id) }}">
                                                                <h6 class="fw-bold text-primary mb-1">
                                                                    {{ $reply->user->name }}
                                                                </h6>
                                                            </a>
                                                            <p class="text-muted small mb-0">
                                                                {{ $reply->posted_at }}
                                                            </p>
                                                        </div>
                                                        @if ((Auth::check() && Auth::id() == $reply->user_id) || Auth::id() == '1')
                                                            <div>
                                                                <button id="editCommentBtn"
                                                                    value="{{ $reply->id }}"
                                                                    class="btn btn-primary editCommentBtn">Edit</button>
                                                                <button id="deleteCommentBtn"
                                                                    value="{{ $reply->id }}"
                                                                    class="btn btn-danger">Delete</button>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="comment-area" val="{{ $reply->content }}">
                                                        <p class="mt-3 mb-4 pb-2" id="display-comment">
                                                            {{ $reply->content }}
                                                        </p>
                                                    </div>


                                                    <div class="small d-flex justify-content-start">
                                                        <div class="d-flex align-items-center">
                                                            <h5 class="like-count p-2 mt-2">{{ count($reply->likes) }}
                                                            </h5>
                                                            <form action="" method="POST">
                                                                @csrf
                                                                <input type="hidden" value="{{ $post->id }}"
                                                                    name="post_id" id="post_id">
                                                                @if ($reply->likes)
                                                                    @php $liked = false; @endphp
                                                                    @foreach ($reply->likes as $like)
                                                                        @if ($like->user_id == Auth::id())
                                                                            <div class="like-container">
                                                                                <button type="button"
                                                                                    class="d-flex btn btn-primary rounded align-items-center me-3 likedCommentBtn"
                                                                                    value="{{ $reply->id }}">
                                                                                    <i
                                                                                        class="far fa-thumbs-up me-2"></i>
                                                                                    <p class="mb-0">Liked</p>
                                                                                </button>
                                                                            </div>
                                                                            @php $liked = true; @endphp
                                                                        @break
                                                                    @endif
                                                                @endforeach
                                                                @if (!$liked)
                                                                    <div class="like-container">
                                                                        <button type="button"
                                                                            class="d-flex btn btn-primary rounded align-items-center me-3 likeCommentBtn"
                                                                            value="{{ $reply->id }}">
                                                                            <i class="far fa-thumbs-up me-2"></i>
                                                                            <p class="mb-0">Like</p>
                                                                        </button>
                                                                    </div>
                                                                @endif
                                                            @else
                                                                <div class="like-container">
                                                                    <button type="button"
                                                                        class="d-flex btn btn-primary rounded align-items-center me-3 likeCommentBtn"
                                                                        value="{{ $reply->id }}">
                                                                        <i class="far fa-thumbs-up me-2"></i>
                                                                        <p class="mb-0">Like</p>
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </form>
                                                    </div>
                                                </div>
                                                <hr class="mt-4">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="no-comments text-center">No Comments Yet</p>
                    @endforelse
                    <div class="m-auto" style="position: relative;left:42%">
                        <div class="comment-pagination mt-4 text-center">
                            {{ $post->comments()->where('parent_id', 0)->latest()->paginate(3)->withQueryString()->links('pagination::simple-bootstrap-5') }}
                        </div>
                    </div>

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
                    <a href="{{ url('section/' . $latest_post_item->categories->first()->slug . '/' . $latest_post_item->slug) }}"
                        class="text-decoration-none">
                        <h6 class="extra-title" style="height:35px;">{{ $latest_post_item->title }}</h6>
                    </a>
                    <a class="text-dark text-decoration-none"
                        href="{{ url('section/' . $latest_post_item->categories->first()->slug) }}">
                        <p class="extra-cat">
                            @foreach ($latest_post_item->categories as $category)
                                <a class="text-dark text-decoration-none"
                                    href="{{ url('section/' . $category->slug) }}">{{ $category->name }}</a>
                                @if (!$loop->last)
                                    |
                                @endif
                            @endforeach
                        </p>
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
<!-- Add Comment -->
<script>
    // Add comment by id

    $(document).on('click', '#addCommentBtn', function() {

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
                var _html = `
                    <div class="comment-container col-md-12 col-lg-10 col-xl-8">
                                            <hr class="mt-4">
                                            <div>
                                                <div class="d-flex flex-start justify-content-between">
                                                    <div>
                                                        <a href="{{ url('user/' . Auth::id()) }}">
                                                            <h6 class="fw-bold text-primary mb-1">` + window
                    .currentUser + `</h6>
                                                        </a>
                                                        <p class="text-muted small mb-0">` + res.comment.posted_at + `</p>
                                                    </div>
                                                    @if (Auth::check())
                                                        <div>
                                                            <button id="editCommentBtn" value="` + res.comment.id + `" class="btn btn-primary editCommentBtn">Edit</button>
                                                            <button id="deleteCommentBtn" value="` + res.comment.id + `"
                                                                class="btn btn-danger">Delete</button>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="comment-area" val="` + res.comment.content + `">
                                                    <p class="mt-3 mb-4 pb-2" id="display-comment">` + res.comment
                    .content +
                    `</p>
                                                </div>
                                                <div class="small d-flex justify-content-start">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="like-count p-2 mt-2">0</h5>
                                                        <form action="" method="POST">
                                                            @csrf
                                                            <input type="hidden" value="{{ $post->id }}" name="post_id" id="post_id">
                                                            <div class="like-container">
                                                                <button type="button" class="d-flex btn btn-primary rounded align-items-center me-3 likeCommentBtn" value="` +
                    res.comment.id + `">
                                                                    <i class="far fa-thumbs-up me-2"></i>
                                                                    <p class="mb-0">Like</p>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <button
                                                            class="d-flex btn btn-primary rounded align-items-center me-3 replyCommentBtn"
                                                            value="` + res.comment.id + `">
                                                            <i class="far fa-comment-dots me-2"></i>
                                                            <p class="mb-0">Reply</p>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="mt-4">
                                            <div class="container">
                                                <div class="reply-section"></div>
                                            </div>
                                            <div class="reply-container"></div>
                                    </div>`;
                if (res.bool) {
                    $('.alert-container').html("");
                    $(".comments").prepend(_html);
                    $("#comment").val('');
                    $(".no-comments").hide();
                } else {
                    alert(res.message);
                }
                vm.text('Post Comment').removeClass('disabled');
            },
            error: function(res) {
                var errors = res.responseJSON.errors;
                var message = '';

                $.each(errors, function(key, value) {
                    message += value + '\n';
                });

                $('.alert-container').html('<div class="alert alert-danger" role="alert">' + message + '</div>');
                vm.text('Post Comment').removeClass('disabled');

            }


        });
    });
</script>
<!-- Delete Comment -->
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
<!-- Reply Comment -->
<script>
    // Add comment by id

    $(document).on('click', '.replyCommentBtn', function() {

        var thisClicked = $(this);
        var parent_id = thisClicked.val();
        var _html = `<!-- Reply comment -->
                        <div class="container">
                            <div class="row d-flex justify-content-end">
                                <div class="col-md-12 col-lg-10 col-xl-8">
                                    <div class="card">
                                        <div class="card-body shadow-sm">
                                            <form action="" method="POST">
                                                @csrf
                                                <div class="d-flex flex-start w-100">
                                                    <div class="form-outline w-100">
                                                        <input type="hidden" value="{{ $post->id }}" name="post_id" id="post_id">
                                                        <input type="hidden" value="` + parent_id + `" name="parent_id" id="parent_id">
                                                        <textarea class="form-control bg-white" id="reply" placeholder="Reply to the comment..."
                                                            rows="4"></textarea>
                                                    </div>
                                                </div>
                                                <div class="float-end mt-2 pt-1">
                                                    <button type="button" id="addReplyCommentBtn" class="btn btn-primary btn-sm">Post
                                                        comment</button>
                                                    <button type="button" class="btn btn-danger btn-sm cancelCommentBtn">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
        $(".reply-section").html("");
        thisClicked.closest(".comment-container").find('.reply-section').html(_html);

    });

    $(document).on('click', '.cancelCommentBtn', function() {
        $(".reply-section").html("");
    });

    $(document).on('click', '#addReplyCommentBtn', function() {

        var thisClicked = $(this);
        var parent_id = $('#parent_id').val();
        var post_id = $('#post_id').val();
        var reply = $('#reply').val();
        window.currentUser = "{{ Auth::user()->name }}";

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
                parent_id: parent_id,
                blog_post_id: post_id,
                content: reply,
                _token: '{{ csrf_token() }}'
            },
            url: "{{ url('reply-comment') }}",
            beforeSend: function() {
                thisClicked.text('Saving...').addClass('disabled');
            },
            success: function(res) {
                var _html = `<div class="comment-container">
                                    <div class="reply" style="width:80%;margin-left:20%!important;">
                                        <div class="d-flex mt-4 justify-content-between">
                                            <div>
                                                <a href="{{ url('user/' . Auth::id()) }}">
                                                    <h6 class="fw-bold text-primary mb-1">` + window.currentUser + `</h6>
                                                </a>
                                                <p class="text-muted small mb-0">
                                                    ` + res.comment.posted_at + `
                                                </p>
                                            </div>
                                                <div>
                                                    <button id="editCommentBtn" value="` + res.comment.id + `" class="btn btn-primary editCommentBtn">Edit</button>
                                                    <button id="deleteCommentBtn" value="` + res.comment.id + `"
                                                        class="btn btn-danger">Delete</button>
                                                </div>
                                        </div>

                                        <div class="comment-area" val="` + res.comment.content + `">
                                            <p class="mt-3 mb-4 pb-2" id="display-comment">
                                                ` + res.comment.content +
                    `
                                            </p>
                                        </div>


                                        <div class="small d-flex justify-content-start">
                                            <div class="d-flex align-items-center">
                                                <h5 class="like-count p-2 mt-2">0</h5>
                                                <form action="" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $post->id }}" name="post_id" id="post_id">
                                                        <div class="like-container">
                                                            <button type="button" class="d-flex btn btn-primary rounded align-items-center me-3 likeCommentBtn" value="` +
                    res.comment.id + `">
                                                                <i class="far fa-thumbs-up me-2"></i>
                                                                <p class="mb-0">Like</p>
                                                            </button>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                        <hr class="mt-4">
                                    </div>
                                </div>`;
                if (res.bool) {
                    thisClicked.closest('.comment-container').find(".alert-container-reply").html("");
                    thisClicked.closest(".comment-container").find(".reply-container").append(
                        _html);
                    $("#reply").val('');
                } else {
                    alert(res.message);
                }
                $(".reply-section").html("");
            },
            error: function(res) {
                var errors = res.responseJSON.errors;
                var message = '';

                $.each(errors, function(key, value) {
                    message += value + '\n';
                });

                thisClicked.closest('.comment-container').find(".alert-container-reply").html('<div class="alert alert-danger" role="alert">' + message + '</div>');
                thisClicked.text('Post Comment').removeClass('disabled');

            }
        });
    });
</script>
<!-- Like Comment -->
<script>
    // Add like

    $(document).on('click', '.likeCommentBtn', function() {

        var thisClicked = $(this);
        var comment_id = thisClicked.closest('.likeCommentBtn').val();
        var post_id = $('#post_id').val();
        var vm = thisClicked.closest('form');
        var container = thisClicked.closest('.like-container');
        window.currentUser = "{{ Auth::user()->name }}";


        if (container.find('.likedCommentBtn').length > 0) {
            return;
        }

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
                blog_post_id: post_id,
                comment_id: comment_id,
                _token: '{{ csrf_token() }}'
            },
            url: "{{ url('add-like') }}",
            beforeSend: function() {
                container.html(
                    `<button type="button" class="d-flex btn btn-primary rounded align-items-center me-3 likedCommentBtn" value="` +
                    comment_id + `">
                                        <i class="far fa-thumbs-up me-2"></i>
                                        <p class="mb-0">Liking...</p>
                                    </button>`).addClass('disabled');
            },
            success: function(res) {
                if (res.bool) {
                    vm.siblings(".like-count").html(res.count);
                } else {
                    alert(res.message);
                }
                container.html(
                    `<button type="button" class="d-flex btn btn-primary rounded align-items-center me-3 likedCommentBtn" value="` +
                    comment_id + `">
                                        <i class="far fa-thumbs-up me-2"></i>
                                        <p class="mb-0">Liked</p>
                                    </button>`).removeClass('disabled');
            }
        });


    });

    // Remove like

    $(document).on('click', '.likedCommentBtn', function() {

        var thisClicked = $(this);
        var comment_id = thisClicked.closest('.likedCommentBtn').val();
        var post_id = $('#post_id').val();
        var vm = $(this).closest('form');
        var container = thisClicked.closest('.like-container');
        window.currentUser = "{{ Auth::user()->name }}";

        if (container.find('.likeCommentBtn').length > 0) {
            return;
        }

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
                blog_post_id: post_id,
                comment_id: comment_id,
                _token: '{{ csrf_token() }}'
            },
            url: "{{ url('delete-like') }}",
            beforeSend: function() {
                container.html(
                    `<button type="button" class="d-flex btn btn-primary rounded align-items-center me-3 likeCommentBtn" value="` +
                    comment_id + `">
                                        <i class="far fa-thumbs-up me-2"></i>
                                        <p class="mb-0">Unliking...</p>
                                    </button>`).removeClass('disabled');
            },
            success: function(res) {
                if (res.bool) {
                    vm.siblings(".like-count").html(res.count);
                } else {
                    alert(res.message);
                }
                container.html(
                    `<button type="button" class="d-flex btn btn-primary rounded align-items-center me-3 likeCommentBtn" value="` +
                    comment_id + `">
                                        <i class="far fa-thumbs-up me-2"></i>
                                        <p class="mb-0">Like</p>
                                    </button>`).removeClass('disabled');
            }
        });


    });
</script>
<!-- Edit Comment -->
<script>
    $(document).on('click', '.editCommentBtn', function() {

        var thisClicked = $(this);
        var comment_id = thisClicked.val();
        var comment_content = thisClicked.closest('.comment-container').find('#display-comment').html().trim();
        var container = thisClicked.closest('.like-container');
        var _html = `<!-- Edit comment -->
                    <div class="container">
                        <div class="row d-flex justify-content-start">
                            <div class="col-md-12 col-lg-10 col-xl-8">
                                <form action="" method="POST">
                                    @csrf
                                    <div class="d-flex flex-start w-100">
                                        <div class="form-outline w-100 mt-3">
                                            <input type="hidden" value="{{ $post->id }}" name="post_id" id="post_id">
                                            <input type="hidden" value="` + comment_id + `" name="comment_id" id="comment_id">
                                            <textarea class="form-control bg-white" id="comment-content" rows="2">` +
            comment_content + `</textarea>
                                        </div>
                                    </div>
                                    <div class="float-end mt-2 pt-1">
                                        <button type="button" id="addEditCommentBtn" class="btn btn-primary btn-sm addEditCommentBtn">Accept
                                            changes</button>
                                        <button type="button" class="btn btn-danger btn-sm cancelEditCommentBtn">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>`;
        thisClicked.closest('.comment-main').siblings('.comment-area').html(_html);

    });

    $(document).on('click', '.cancelEditCommentBtn', function() {

        var thisClicked = $(this);
        var comment_content = thisClicked.closest('.comment-container').find('#comment-content').html().trim();

        thisClicked.closest(".comment-area").html(`<p class="mt-3 mb-4 pb-2" id="display-comment">
                                        ` + comment_content + `
                                        </p>`);
    });

    $(document).on('click', '.addEditCommentBtn', function() {

        var thisClicked = $(this);
        var comment_id = $('#comment_id').val();
        var post_id = $('#post_id').val();
        var comment_content = $('#comment-content').val();
        window.currentUser = "{{ Auth::user()->name }}";

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
                comment_id: comment_id,
                blog_post_id: post_id,
                content: comment_content,
                _token: '{{ csrf_token() }}'
            },
            url: "{{ url('update-comment') }}",
            beforeSend: function() {
                thisClicked.text('Saving...').addClass('disabled');
            },
            success: function(res) {
                if (res.bool) {
                    thisClicked.closest('.comment-container').find(".alert-container-reply").html("");
                    thisClicked.closest(".comment-area").html(`<p class="mt-3 mb-4 pb-2" id="display-comment">
                                        ` + comment_content + `
                                        </p>`);
                } else {
                    alert(res.message);
                }
            },
            error: function(res) {
                var errors = res.responseJSON.errors;
                var message = '';

                $.each(errors, function(key, value) {
                    message += value + '\n';
                });

                thisClicked.closest('.comment-container').find(".alert-container-reply").html('<div class="alert alert-danger" role="alert">' + message + '</div>');
                thisClicked.text('Post Comment').removeClass('disabled');


            }
        });

    });
</script>

@endauth
@endsection
