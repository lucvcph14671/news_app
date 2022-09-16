@extends('admin_master')
@section('title', 'Danh sách bài viết')
@section('css')
    <link href="{{ asset('assets/css/jquery.datetimepicker.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .error {
            color: brown;
        }

        figure img {
            width: 700px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

@endsection
@section('content')

    <!--begin::Header-->
    <div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header"
        data-kt-sticky-offset="{default: '200px', lg: '300px'}">
        <!--begin::Container-->
        <div class="container-xxl d-flex align-items-center justify-content-between" id="kt_header_container">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-5 pb-lg-0"
                data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
                <!--begin::Heading-->
                <h1 class="text-dark fw-bold my-0 fs-2">Bài viết</h1>
                <!--end::Heading-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-line text-muted fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="../dist/index.html" class="text-muted">Admin</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Menu</li>
                    <li class="breadcrumb-item text-dark">Bài viết</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title=-->
            <!--begin::Wrapper-->
            <div class="d-flex d-lg-none align-items-center ms-n2 me-2">
                <!--begin::Aside mobile toggle-->
                <div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                    <span class="svg-icon svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                fill="black" />
                            <path opacity="0.3"
                                d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Aside mobile toggle-->
                <!--begin::Logo-->
                <a href="../dist/index.html" class="d-flex align-items-center">
                    <img alt="Logo" src="assets/media/logos/logo-default.svg" class="h-40px" />
                </a>
                <!--end::Logo-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Toolbar wrapper-->
            <div class="d-flex flex-shrink-0">
                <!--begin::Create app-->
                @can('post_add')
                <div class="d-flex ms-3">
                    <button class="btn btn-info add_post_form" tooltip="New App" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_create_app " id="kt_toolbar_primary_button">Thêm bài viết</button>
                </div>
                @endcan
                <!--end::Create app-->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Container-->

    </div>
    <div class="mx-10">
        @include('admin/alert/alert_success')
    </div>
    <!--end::Header-->
    <div class="container">
        <table class="table table-rounded table-row-bordered border gy-7 gs-7" id="post">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                    <th>Stt</th>
                    <th>Người viết bài</th>
                    <th>Time đăng bài</th>
                    <th>Ảnh</th>
                    <th>Chuyên mục</th>
                    <th>Bài viết</th>
                    <th class="text-center" style="width: 155px">Edit</th>
                </tr>
            </thead>
            <tbody>

            </tbody>

        </table>
    </div>
    <div class="modal fade" id="viewPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bài viết</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3><b>Tiêu đề: <b id="view-title" class="text-info"></b> </b></h3>
                    <span id="view-desc"></span>
                    <p> </p>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title" id="exampleModalLabel">Nhận xét</h5>
                    <table class="table table-rounded table-row-bordered border gy-7 gs-7" id="comments">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                <th>Stt</th>
                                <th>Comment</th>
                                <th>Người nhận xét</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Thoát</button>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('admin/post/edit_post') --}}
    @include('admin/post/post')

@endsection
@section('js')
    <script src="{{ asset('assets/js/message.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('assets/js/jquery.datetimepicker.full.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
    
        jQuery('#datetimepickerCreate').datetimepicker({
            format: 'Y/m/d H:i:s ',
        });
        $.datetimepicker.setLocale('vi');

        jQuery('#datetimepicker').datetimepicker({
            format: 'Y/m/d H:i:s ',
        });
        $.datetimepicker.setLocale('vi');
        
        const constDataTable = () => {

            $(document).ready(function() {
                var i = "1";

                $('#post').DataTable({
                    ajax: 'admin/data_post',
                    columns: [{
                            render: function(data, type, row, meta) {
                                return i++;
                            }
                        },
                        {
                            data: 'user_name'
                        },
                        {
                            data: 'post_at'
                        },
                        {
                            render: function(data, type, row, meta) {
                                return `<img src="${row.image}" alt="" width="150" height="50">`;
                            }
                        },
                        {
                            render: function(data, type, row, meta) {
                                return `<button class="btn btn-sm btn-success">${row.category_name}</button>`;
                            }
                        },
                        {
                            render: function(data, type, row, meta) {
                                return `
                                    @can('post_view')
                                        <button class="btn btn-sm btn-info view-post" data-bs-toggle="modal"
                                        data-bs-target="#viewPost" value="${row.id}">Xem</button>
                                    @endcan
                                `;
                            }
                        },
                        {
                            render: function(data, type, row, meta) {
                                return `
                            <div class="d-flex">
                               @can('post_edit')
                                    <button class="btn btn-sm btn-info me-2 edit_post" tooltip="New App" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_update_app" id="kt_toolbar_primary_button" value="${row.id}">Sửa</button>
                               @endcan
                                
                                @can('post_delete')
                                <form action="" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="border-0 btn-sm btn-danger delete_post" value="${row.id}">Xóa</button>
                                </form>
                                @endcan
                            </div>
                            `;
                            }
                        }
                    ]
                });
            });

        }

        constDataTable();

        function deletePost() {
            var id = $('.delete_post').val();
            const deletePost = {
                id: id,
            }

            $.ajax({
                type: "DELETE",
                url: "admin/delete_post/" + id,
                data: deletePost,

                success: function(response) {
                    if (response.status == '200') {
                        message(response.message, 'success')
                        $('#post').DataTable().ajax.reload(null, false);
                    } else if (response.status == '404') {
                        message(response.message, 'error')
                    }
                },

            });

        }

        function confirmShow(){
            $(document).on('click', '.delete_post', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Bạn có muốn xóa?',
                    text: "Xóa bài viết này!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có, Xóa ngay!'
                }).then((result) => {
                    if (result.isConfirmed) {
                         deletePost();
                    }
                })
            });

            $(document).on('click', '.delete_comment', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Bạn có muốn xóa?',
                    text: "Xóa nhận xét này!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có, Xóa ngay!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        daleteComment();
                    }
                })
            });
        }

        confirmShow();

        function viewPost(){
            $(document).on('click', '.view-post', function(e) {
                e.preventDefault();
                var id = $(this).val();
                var i = "1";
                $.ajax({
                    type: "get",
                    url: "admin/edit_post/" + id,
                    success: function(response) {
                        $('#view-title').html(response.post.title);
                        $('#view-desc').html(response.post.desc);
                    }
                });
                
                $('#comments').DataTable({
                    ajax: 'admin/comment/' + id,
                    paging: false,
                    searching: false,
                    destroy: true,
                    columns: [{
                            render: function(data, type, row, meta) {
                                return i++;
                            }
                        },
                        {
                            data: 'comment'
                        },
                        {
                            data: 'user_name'
                        },
                        {
                            render: function(data, type, row, meta){
                                return `
                                    <form method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger delete_comment" value="${row.id}">Xóa</button>
                                    </form>
                                `;
                            }
                        }
                    ]
                });         

            });
        }

        viewPost();
        function editPost() {
            $(document).on('click', '.edit_post', function(e) {
                e.preventDefault();
                var id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "admin/edit_post/" + id,
                    success: function(response) {
                        $('#title').val(response.post.title);
                        $('#save-form-update').val(response.post.id);
                        $('#datetimepicker').val(response.post.post_at);
                        $('#summernote1').summernote('code',response.post.desc);
                        // editor.setData(response.post.desc);
                        $('#id_category option[value="' + response.post.id_category + '"]').prop(
                            'selected',
                            true);
                        $("#previewImg").attr("src", response.post.image);
                        $(".id-form-post").attr("value", response.post.id);
                    }
                });

            });
        }

        editPost();

        function updatePost() {

            $('#form-post-update').submit(function(e) {

                e.preventDefault();
                var id = $('.id-form-post').val();
                var image = $('img#previewImg').attr('src');
                var title = $('#title').val();
                var id_category = $('#id_category').val();
                var datetimepicker = $('#datetimepicker').val();
                var desc = $('#desc').val();

                let formData = new FormData($('#form-post-update')[0]);
                var dataForm = {
                    id,
                    image,
                    title,
                    id_category,
                    datetimepicker,
                    desc

                };
                $.ajax({
                    url: 'admin/update_post/' + id,
                    method: 'post',
                    data: formData,

                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $("#kt_modal_update_app").modal('hide');
                        if (response.status == '200') {
                            message(response.message, 'success')
                            $('#post').DataTable().ajax.reload(null, false);
                        } else if (response.status == '404') {
                            message(response.message, 'error')
                        }
                    },
                    error: function(error) {
                        $('#desc-er').text(error.responseJSON.errors.desc[0]);
                    },
                });

            });
        }

        updatePost();

        function createPost() {
            $("#form-post-create").validate({
                rules: {
                    "title": {
                        required: true,
                    },
                    "id_category": {
                        required: true,
                    },
                },
                messages: {

                    "title": {
                        required: "Vui lòng nhập tiêu đề!",
                    },
                    "id_category": {
                        required: "Vui lòng chọn danh mục!",
                    },
                },
            });
            $('#form-post-create').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: 'admin/post_add',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $("#kt_modal_create_app").modal('hide');
                        if (response.status == '200') {
                            message(response.message, 'success')
                            $('#post').DataTable().ajax.reload(null, false);
                        } else if (response.status == '404') {
                            message(response.message, 'error')
                        }
                    },
                    error: function(error) {
                        $('#desc-er-create').text(error.responseJSON.errors.desc[0]);
                    },
                });

            });
        }

        createPost();

        function previewfile(input) {
            var file = $(".image-preview").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $("#previewImg").attr("src", reader.result);
                    $('#oldImage').val(reader.result);
                }
                reader.readAsDataURL(file);
            }
        }

        function previewfilecreate(input) {
            var file = $(".image-preview-create").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $("#previewImgCreate").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }

        function daleteComment() {
            var id = $('.delete_comment').val();
            const deleteComment = {
                id: id,
            }

            $.ajax({
                type: "DELETE",
                url: "admin/delete_comment/" + id,
                data: deleteComment,

                success: function(response) {
                    if (response.status == '200') {
                        message(response.message, 'success')
                        $('#comments').DataTable().ajax.reload(null, false);
                    } else if (response.status == '404') {
                        message(response.message, 'error')
                    }
                },

            });
        }
        
    </script>
    <script>
        $(document).ready(function() {
            $("#summernote").summernote({
                height: 400,
            });
            $('.dropdown-toggle').dropdown();
        });
        $(document).ready(function() {
            $("#summernote1").summernote({
                height: 400,
            });
            $('.dropdown-toggle').dropdown();
        });
    </script>

@endsection
