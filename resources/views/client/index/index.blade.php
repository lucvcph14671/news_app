@extends('client_master')
@section('title', 'BizNews - Tin tức mới nhất')
@section('slider')
    <!-- Main News Slider Start -->
    @include('client/slider/slider')
    <!-- Main News Slider End -->


    <!-- Breaking News Start -->
    @include('client/slider/slider_new')
    <!-- Breaking News End -->


    <!-- Featured News Slider Start -->
    @include('client/new/featured_news')
    <!-- Featured News Slider End -->
@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="section-title">
                <h4 class="m-0 text-uppercase font-weight-bold">Tin tức</h4>
                <a class="text-secondary font-weight-medium text-decoration-none">Tất cả</a>
            </div>
        </div>
        @foreach ($posts as $post)
            <div class="col-lg-6">
                <div class="position-relative mb-3">
                    <img class="img-fluid w-100" src="{{asset($post->image)}}" style="object-fit: cover;">
                    <div class="bg-white border border-top-0 p-4">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2">{{$post->category->name}}</a>
                            <a class="text-body" href=""><small>{{ date('h:m d/m/Y', strtotime($post->created_at)) }}</small></a>
                        </div>
                        <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="{{route('detail_new', $post->id)}}">{{$post->title}}</a>
                        <p class="m-0">{{substr($post->desc, 3, 100);}}...</p>
                    </div>
                    <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle mr-2" src="https://anhdep123.com/wp-content/uploads/2020/11/avatar-facebook-mac-dinh-nam.jpeg" width="25" height="25"
                                alt="">
                            <small>{{$post->nameUser->name}}</small>
                        </div>
                        <div class="d-flex align-items-center">
                            {{-- <small class="ml-3"><i class="far fa-eye mr-2"></i>12345</small> --}}
                            <small class="ml-3"><i class="far fa-comment mr-2"></i>{{count($post->countComment)}}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
