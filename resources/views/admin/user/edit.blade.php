@extends('layouts.master')


@section('title', 'Edit Users')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">

        <div class="card-header">
            <h4>Edit Users
                <a href="{{ url('admin/users') }}" class="btn btn-danger float-end">BACK</a>
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

            <div class="mb-3">
                <label>Full Name</label>
                <p class="form-control">{{ $user->name }}</p>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <p class="form-control">{{ $user->email }}</p>
            </div>
            <div class="mb-3">
                <label>Created At</label>
                <p class="form-control">{{ $user->created_at->format('d/m/Y') }}</p>
            </div>

            <form action="{{ url('admin/update-user/'.$user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Role As</label>
                    <select name="role_as" required class="form-control">
                        <option value="1" {{ $user->role_as == '1' ? 'selected':'' }}>Admin</option>
                        <option value="2" {{ $user->role_as == '2' ? 'selected':'' }}>Author</option>
                        <option value="0" {{ $user->role_as == '0' ? 'selected':'' }}>User</option>
                    </select>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save User</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
