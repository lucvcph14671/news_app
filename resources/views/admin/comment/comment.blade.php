@extends('admin_master')
@section('title', 'Trang quản lí comments')
@section('content')
    <div class="container">

        <table class="table table-rounded table-row-bordered border gy-7 gs-7" id="comments">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                    <th>Stt</th>
                    <th>Comment</th>
                    <th>Người nhận xét</th>
                    <th>Bài viết</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>

            </tbody>

        </table>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/js/message.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        function commentList() {
            $(document).ready(function() {
                var i = "1";

                $('#comments').DataTable({
                    ajax: 'admin/comment_data',
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
                            data: 'title_post.title'
                        },
                        {
                            render: function(data, type, row, meta) {
                                return `
                                    <form method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger delete_comment" value="${row.id}" onclick="confirm('Bạn có chắc chắn muốn xóa nhận xét này?')">Xóa</button>
                                    </form>
                                `;
                            }
                        }

                    ]
                });
            });
        }
        commentList();

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
                        daleteComment();
                    }
                });
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
@endsection
