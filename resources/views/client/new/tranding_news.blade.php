<div class="mb-3">
    <div class="section-title mb-0">
        <h4 class="m-0 text-uppercase font-weight-bold">Bài viết nổi bật</h4>
    </div>
    <div class="bg-white border border-top-0 p-3">
        @foreach ($posts_4 as $post)
            <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                <img class="img-fluid" src="{{$post->category->image}}" alt="">
                <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                    <div class="mb-2">
                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2">{{$post->category->name}}</a>
                        <a class="text-body" href=""><small>{{ date('h:m d/m/Y', strtotime($post->created_at)) }}</small></a>
                    </div>
                    <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="{{route('detail_new', $post->id)}}">{{$post->title}}</a>
                </div>
            </div>
        @endforeach

    </div>
</div>
