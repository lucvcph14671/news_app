@extends('admin_master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="container">

        <table class="table table-rounded table-row-bordered border gy-7 gs-7" id="user">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                    <th>Stt</th>
                    <th>Họ tên</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->phone }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            @can('permission_update')
                                <button id="update_role" value="{{ $user->id }}" class=" btn btn-sm btn-info get-role-user"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    onclick="showFormEditUser({{ $user->id }},'{{ route('admin.show-form-edit-user', $user->id) }}');">Sửa
                                    thông tin</button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    {{-- <div id="form-role">

    </div> --}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông tin tài khoản</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data-user" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" name="name" value="" id="name"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ảnh đại diện</label>
                            <input type="file" onchange="previewfile(this)" class="form-control" id="avatar" aria-describedby="emailHelp">
                            <img src="" id="previewImg" class="previewImg" alt="" width="100px">
                        </div>
                        <div>
                            <span class="form-label">Chọn vai trò cho tài khoản</span>
                            <select id="role_id" class="js-example-basic-multiple form-control" name="role[]"
                                multiple="multiple">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }} ( {{ $role->desc_name }} )
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Thoát</button>
                    <button class="btn mt-2 btn-sm btn-info" id="user_role" value=""
                        onclick="confirm('Bạn có chắc chắn muốn thay đổi quyền tài khoản này không?')">Cập nhập</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/js/message.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });

        function userList() {
            $(document).ready(function() {
                var i = "1";
                $('#user').DataTable();

            });
        }
        userList();

        function showFormEditUser(user_id, url) {
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    $('#name').val(response.user[0]['name']);
                    $('#email').val(response.user[0]['email']);
                    $('#phone').val(response.user[0]['phone']);
                    $('#user_role').attr("value", user_id);
                    $("#previewImg").attr("src", response.user[0]['avatar']);
                    $('#role_id').val(response.data).trigger('change');

                }

            });
        }

        function updateRole() {
            var role_id = $('#role_id').val();
            var id = $('#user_role').val();
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var avt = $('#avatar').val();
            var avatar = $('img#previewImg').attr('src');

            const dataUser = {
                name: name,
                email: email,
                phone: phone,
                avatar: avatar,
                avt: avt,
            }
            const data = {
                role_id: role_id,
                dataUser: dataUser,
            }
            $.ajax({
                type: "put",
                url: 'admin/update_role/' + id,
                data: data,
                success: function(response) {
                    $("#exampleModal").modal('hide');
                    if (response.status == '200') {
                        // var table = $('#user').DataTable({
                        //     ajax: 'admin/update_role/' + id,
                        // });

                        // setInterval(function() {
                        //     table.ajax.reload(null, false); // user paging is not reset on reload
                        // }, 3);
                        // $('#user').DataTable().ajax.reload(null, false);
                        message(response.message, 'success')
                    } else if (response.status == '404') {
                        message(response.message, 'error')
                    }
                },

            })
        }

        function confirm(title, icon = "warning") {
            swal({
                    title: title,
                    icon: icon,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        updateRole();
                    }
                });
        }

        function previewfile(input) {
            var file = $("#avatar").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $(".previewImg").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
