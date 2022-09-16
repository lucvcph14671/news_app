<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Vai trò tài khoản</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div>
                <span class="form-label">Chọn vai trò cho tài khoản</span>
                <select id="role_id" class="js-example-basic-multiple form-control" name="role[]" multiple="multiple">
                @foreach($roles as $role)
                <option value="{{$role->id}}" >{{$role->name}} ( {{$role->desc_name}} )</option>
                @endforeach
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Thoát</button>
          <button class="btn mt-2 btn-sm btn-info" id="user_role" value="" onclick="confirm('Bạn có chắc chắn muốn thay đổi quyền tài khoản này không?')">Cập nhập</button>
        </div>
      </div>
    </div>
  </div>
  