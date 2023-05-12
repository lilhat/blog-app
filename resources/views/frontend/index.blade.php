@extends('layouts.app')


@section('title', 'BlogMySupplies')
@section('meta_description', 'Blogging website about construction projects.')
@section('meta_keyword', 'Construct DIY Supplies')

@section('content')


    <div class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme">
                        @foreach ($all_categories as $all_cat_item)
                            <div class="item">
                                <a href="{{ url('section/' . $all_cat_item->slug) }}" class="text-decoration-none text-dark">
                                    <div class="card" style="height:300px!important;">
                                        <img src="{{ asset('uploads/category/' . $all_cat_item->image) }}" alt="Image"
                                            style="height:175px;">
                                        <div class="card-body">
                                            <h4>{{ $all_cat_item->name }}</h4>
                                            <p>{{ $all_cat_item->description }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h4>BlogMySupplies</h4>
                    </div>
                    <hr class="my-4"/>
                    <div class="text-center">
                        <p>
                            BlogMySupplies is a comprehensive online platform designed for construction enthusiasts,
                            professionals, and DIYers alike. The website offers a wide range of engaging and informative
                            articles, news, and resources on various topics related to construction, home improvement, and
                            renovation. <br><br>

                            With a focus on providing valuable insights and helpful tips, BlogMySupplies covers a variety of
                            subjects, including building materials, tools and equipment, safety regulations, sustainability,
                            design and architecture, and more. <br><br>

                            In addition to its wealth of informative content, BlogMySupplies also offers a vibrant community
                            of like-minded individuals who can share their own experiences, insights, and opinions. Users
                            can connect with one another through comments, forums, and social media, fostering a sense of
                            community and support among construction enthusiasts. <br><br>

                            Whether you're a seasoned professional in the industry or just getting started with a DIY
                            project, BlogMySupplies is the ultimate resource for construction-related information and
                            inspiration. With its user-friendly interface, engaging content, and robust community,
                            BlogMySupplies is the perfect destination for anyone looking to expand their knowledge and
                            connect with others in the construction world. <br><br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                            <a href="{{ url('section/'.$latest_post_item->categories->first()->slug.'/'.$latest_post_item->slug) }}" class="text-decoration-none">
                                <h6 class="extra-title"  style="height:35px;">{{ $latest_post_item->title }}</h6>
                            </a>
                            <a class="text-dark text-decoration-none" href="{{ url('section/'.$latest_post_item->categories->first()->slug) }}">
                                <p class="extra-cat">
                                    @foreach ($latest_post_item->categories as $category)
                                        <a class="text-dark text-decoration-none" href="{{ url('section/'.$category->slug) }}">{{ $category->name }}</a>
                                        @if (!$loop->last)
                                            |
                                        @endif
                                    @endforeach
                                </p>
                            </a>
                            <p class="post-meta">
                                Posted by
                                <a href="{{ url("user/". $latest_post_item->user->id) }}">{{ $latest_post_item->user->name }}</a>
                                on {{ $latest_post_item->created_at->format('d-m-Y') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



@endsection
