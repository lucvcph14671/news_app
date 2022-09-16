@extends('admin_master')
@section('title', 'Trang quản lí chuyên mục')
@section('content')
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Invoice-->

        <div class="card">
            <!--begin::Body-->
            <div class="card-body p-lg-20">
                @include('admin/alert/alert_success')
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-xl-row">
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
                        <!--begin::Head-->
                        <div class="d-flex flex-stack flex-wrap mb-10 mb-lg-15">
                            <!--begin::Logo-->

                            <!--end::Logo-->
                            <!--begin::Actions-->
                            <div class="my-2">
                                <a class="btn btn-sm btn-primary">Chuyên mục</a>
                                <a href="{{ route('admin.category') }}" class="btn btn-sm btn-success me-2"
                                    onclick="window.print()">Print</a>
                            </div>
                            <!--end::Actions-->

                        </div>

                        @include('admin/alert/alert_success')
                        <!--end::Head-->
                        <!--begin::Wrapper-->
                        <form action="{{ isset($category) ? route('admin.update_category', $category->id) : route('admin.add_category') }}" method="post">
                            @csrf
                            @if (isset($category))
                                @method('PUT')
                            @endif
                            <div class="mb-0">
                                <!--begin::Label-->
                                <div class="fw-bolder fs-3 text-gray-800 mb-8">Thêm mới chuyên mục</div>
                                <!--end::Label-->
                                <!--begin::Row-->
                                <div class="row g-5 mb-11">
                                    <!--end::Col-->
                                    <div class="col-sm-12">
                                        <!--end::Label-->
                                        <div class="fw-bold fs-7 text-gray-600 mb-1">Tên chuyên mục:</div>
                                        <!--end::Label-->
                                        <!--end::Col-->
                                        <div class="fw-bolder fs-6 text-gray-800">
                                            <input type="text" class="form-control" name="name"
                                                value="{{ isset($category) ? $category->name : old('name') }}">
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="text-danger text-sm"> {{ $errors->first('name') }}</span>
                                        @endif
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-5 mb-12">
                                    <!--end::Col-->
                                    <div class="col-sm-12">
                                        <!--end::Label-->
                                        <div class="fw-bold fs-7 text-gray-600 mb-1">Chuyên mục cha:</div>
                                        <!--end::Label-->
                                        <!--end::Text-->
                                        <div class="fw-bolder fs-6 text-gray-800">
                                            <select name="id_level" class="form-select">
                                                <option value="">Chọn chuyên mục cha</option>
                                                @foreach ($id_levels as $id_level)
                                                    <option value="{{ $id_level->id }}" 
                                                    @if (isset($category))
                                                     @selected($category->id_level == $id_level->id)
                                                    @endif>{{ $id_level->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Col-->
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-info">Lưu</button>
                                    </div>

                                </div>
                                <!--end::Row-->
                            </div>
                        </form>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Sidebar-->
                    <div class="m-0">
                        <!--begin::Invoice sidebar-->
                        <div
                            class="d-print-none border border-dashed border-gray-300 card-rounded h-lg-100 min-w-md-350px p-9 bg-lighten">
                            <!--begin::Title-->
                            <h6 class="mb-8 fw-boldest text-gray-600 text-hover-primary">Danh sách chuyên mục</h6>
                            <!--end::Title-->
                            <div class="table-responsive border-bottom mb-9">
                                <table class="table mb-3">
                                    <thead>
                                        <tr class="border-bottom fs-6 fw-bolder text-gray-400">
                                            <th class="min-w-10px pb-2">Stt</th>
                                            <th class="min-w-100px text-end pb-2">Chuyên mục</th>
                                            <th class="min-w-50px text-end pb-2">Chuyên mục con</th>
                                            <th class="min-w-100px text-end pb-2"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $key => $list)
                                            <tr class="fw-bolder text-gray-700 fs-5 text-end">
                                                <td class="d-flex align-items-center pt-6">{{ $key + 1 }}</td>
                                                <td class="pt-6">{{ $list->name }}</td>
                                                <td class="pt-6">
                                                    <select name="id_level" class="form-select">
                                                        <option value="">Không</option>
                                                        @foreach ($id_levels as $id_level)
                                                            @if ( $id_level->id_level == $list->id)
                                                                <option value="{{ $id_level->id }}" selected>{{ $id_level->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="pt-6 text-dark fw-boldest d-flex">
                                                    <a href="{{route('admin.edit_category', $list->id)}}" class="border-0 btn-sm btn-info me-1">Sửa</a>
                                                    <form action="{{ route('admin.delete_category', $list->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="border-0 btn-sm btn-danger show_confirm" >Xóa</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $categories->links() }}
                        </div>
                        <!--end::Invoice sidebar-->
                    </div>
                    <!--end::Sidebar-->
                </div>
                <!--end::Layout-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Invoice-->
    </div>

@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Bạn có chắc chắn muốn xóa bản ghi này không?`,
                    text: "Bạn chắc chắn muốn xóa.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection
