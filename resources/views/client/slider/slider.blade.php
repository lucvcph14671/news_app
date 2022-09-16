<div class="container-fluid">
    <div class="row">
        <div class="col-lg-7 px-0">
            <div class="owl-carousel main-carousel position-relative">
                @foreach ($posts as $post)
                    <div class="position-relative overflow-hidden" style="height: 500px;">
                        <img class="img-fluid h-100" src="{{ asset($post->image) }}" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                    >{{ $post->category->name }}</a>
                                <a class="text-white"
                                    >{{ date('d/m/Y', strtotime($post->created_at)) }}</a>
                            </div>
                            <a class="h2 m-0 text-white text-uppercase font-weight-bold"
                            href="{{route('detail_new', $post->id)}}">{{ $post->title }}</a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="col-lg-5 px-0">
            <div class="row mx-0">
                @foreach ($posts_4 as $post)
                    <div class="col-md-6 px-0">
                        <div class="position-relative overflow-hidden" style="height: 250px;">
                            <img class="img-fluid w-100 h-100" src="{{asset($post->image)}}" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2">{{$post->category->name}}</a>
                                    <a class="text-white" href=""><small>{{ date('d/m/Y', strtotime($post->created_at)) }}</small></a>
                                </div>
                                <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="{{route('detail_new', $post->id)}}">{{$post->title}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
