@extends('client_master')
@section('title', 'Chi tiết bài viết')
@section('css')
    <style>
        .image img {
            width: 690px;
        }
    </style>
@endsection
@section('slider')
    <!-- Featured News Slider Start -->
    @include('client/new/featured_news')
    <!-- Featured News Slider End -->
@endsection
@section('content')
    <!-- News Detail Start -->
    <div class="position-relative mb-3">
        <img class="img-fluid w-100" src="{{ asset($detailPost->image) }}" style="object-fit: cover;">
        <div class="bg-white border border-top-0 p-4">
            <div class="mb-3">
                <a
                    class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2">{{ $detailPost->category->name }}</a>
                <a class="text-body">{{ date('h:m d/m/Y', strtotime($detailPost->created_at)) }}</a>
            </div>
            <div class="">
                <h1></h1>
                {!! $detailPost->desc !!}
            </div>
        </div>
        <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
            <div class="d-flex align-items-center">
                <img class="rounded-circle mr-2"
                    src="https://anhdep123.com/wp-content/uploads/2020/11/avatar-facebook-mac-dinh-nam.jpeg" width="25"
                    height="25" alt="">
                <span>{{ $detailPost->nameUser->name }}</span>
            </div>
            <div class="d-flex align-items-center">
                {{-- <span class="ml-3"><i class="far fa-eye mr-2"></i>0</span> --}}
                <span class="ml-3"><i class="far fa-comment mr-2"></i>{{ count($countComment) }}</span>
            </div>
        </div>
    </div>
    <!-- News Detail End -->

    @include('client/comments/comment_list')

    <!-- Comment Form Start -->
    @include('client/comments/comment')
    <!-- Comment Form End -->

@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="{{ asset('assets/js/message.js') }}"></script>
    <script>
        function comments() {
            $("#form-user-comment").validate({
                rules: {
                    "comment": {
                        required: true,
                    },
                },
                messages: {

                    "comment": {
                        required: "Bạn chưa nhập nhận xét!",
                    },
                },
            });
            $('#form-user-comment').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: '/comment',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == '200') {
                            location.reload();
                            message(response.message, 'success')
                            // $("#loading").load("/detail_new/32");
                        } else if (response.status == '404') {
                            message(response.message, 'error')
                        } else if (response.status == '400') {
                            message(response.message, 'error')
                        }
                    },
                    error: function(error) {
                        // $('#desc-er-create').text(error.responseJSON.errors.desc[0]);
                    },
                });

            });
        }

        comments();

        function confirm(title, icon = "warning") {
            event.preventDefault();
            swal({
                    title: title,
                    icon: icon,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        deleteComment();
                    }
                });
        }

        function deleteComment() {
            var id = $('.delete_comment').val();
            const deletePost = {
                id: id,
            }

            $.ajax({
                type: "DELETE",
                url: "/delete_comment/" + id,
                data: deletePost,

                success: function(response) {
                    if (response.status == '200') {
                        message(response.message, 'success')
                        location.reload();
                        // $("#loading").load("/detail_new/32");
                    } else if (response.status == '404') {
                        message(response.message, 'error')
                    }
                },

            });
        }
    </script>
@endsection
