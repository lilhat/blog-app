@extends('layouts.master')


@section('title', 'Category')

@section('content')


    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>View Category</h4>
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
                                <th>Category Name</th>
                                <th>Image</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/category/' . $item->image) }} " width="50px" height="50px"
                                            alt="img">
                                    </td>
                                    <td>{{ $item->status == '1' ? 'Hidden' : 'Shown' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

@endsection
