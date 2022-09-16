<!--begin::Modals-->
<!--begin::Modal - Create App-->
<div class="modal fade" id="kt_modal_update_app" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>Bài viết</h2>
                <span id="okok"></span>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body py-lg-10 px-lg-10">
                <!--begin::Stepper-->
                <form action="" method="post" id="form-post-update" class="form-post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="container-xxl">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Tiêu đề bài viết" />
                        <span class="text-danger text-sm" id="error-title"></span>
                        <div class="mt-4">
                            <label class="form-label">Danh mục</label>
                            <select class="form-select" id="id_category" name="id_category" aria-label="Select example">
                                <option value="">Danh mục bài viết</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <label class="form-label">Ảnh</label>
                            <input type="file" name="image" id="image" onchange="previewfile(this)"
                                class="form-control image-preview" />
                            <img class="pt-2" src="" id="previewImg" alt="" width="100">
                            <input type="hidden" name="oldImage" id="oldImage">
                        </div>
                        <div class="mt-4">
                            <label for="" class="form-label">Thời gian đăng bài</label>
                            <input id="datetimepicker" name="post_at" type="text" class="form-control">
                        </div>
                        <div class="mt-4">
                            <label class="form-label">Nội dung</label>
                            <textarea name="desc" id="summernote1" class="form-control" rows="4"></textarea>
                            <p id="desc-er-create" class="text-danger"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                            <button class="btn btn-primary save_form id-form-post" value="">Lưu</button>
                        </div>

                    </div>
                </form>
                <!--end::Stepper-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Create App-->
<!--end::Modals-->
<div class="modal fade" id="kt_modal_create_app" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>Bài viết</h2>
                <span id="okok"></span>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body py-lg-10 px-lg-10">
                <!--begin::Stepper-->
                <form action="" method="post" id="form-post-create" enctype="multipart/form-data">
                    @csrf
                    <div class="container-xxl">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" name="title" placeholder="Tiêu đề bài viết" />
                        <span class="text-danger text-sm" id="error-title"></span>
                        <div class="mt-4">
                            <label class="form-label">Danh mục</label>
                            <select class="form-select" name="id_category" aria-label="Select example">
                                <option value="">Danh mục bài viết</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="mt-4">
                            <label class="form-label">Ảnh</label>
                            <input type="file" name="image" id="image" onchange="previewfilecreate(this)"
                                class="form-control image-preview-create" />
                            <img class="pt-2" src="" id="previewImgCreate" alt="" width="100">
                        </div>
                        <div class="mt-4">
                            <label for="" class="form-label">Thời gian đăng bài</label>
                            <input id="datetimepickerCreate" name="post_at" type="text" class="form-control">
                        </div>
                        <div class="mt-4">
                            <label class="form-label">Nội dung</label>
                            <textarea name="desc" id="summernote" class="form-control" rows="4"></textarea>
                            <p id="desc-er-create" class="text-danger"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                            <button class="btn btn-primary">Lưu</button>
                        </div>

                    </div>
                </form>
                <!--end::Stepper-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
