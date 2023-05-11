@extends('layouts.master')


@section('title', 'View Posts')

@section('content')

<div class="modal" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ url('author/delete-post') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Delete Post</h5>
                    <button type="button" class="close" id="closeModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="post_delete_id" id="post_id">
                    <p>Are you sure you want to delete this post?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" id="closeModal" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid px-4">

    <div class="card mt-4">

        <div class="card-header">
            <h4>View Posts
                <a href="{{ url('author/add-post') }}"class="btn btn-primary float-end">Add Posts</a>
            </h4>
        </div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="myDataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                @foreach ($item->categories as $category)
                                    {{ $category->name }}
                                    @if (!$loop->last)
                                    ,
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>
                                <img src="{{ asset('uploads/post/'.$item->image) }} " width="50px" height="50px" alt="img">
                            </td>
                            <td>{{ $item->status == '1' ? 'Hidden':'Shown' }}</td>
                            <td>
                                <a href="{{ url('author/edit-post/'.$item->id)}}" class="btn btn-success">Edit</a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger deletePostBtn"
                                value="{{ $item->id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $(document).on('click', '.deletePostBtn', function (e) {
                e.preventDefault();

                var post_id = $(this).val();
                $('#post_id').val(post_id);
                $('#deleteModal').modal('show');
            });
            $(document).on('click', '#closeModal', function (e) {
                e.preventDefault();

                $('#deleteModal').modal('hide');
            });
        });
    </script>

@endsection
