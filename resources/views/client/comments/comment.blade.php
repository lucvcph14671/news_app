<div class="mb-3">
    <div class="section-title mb-0">
        <h4 class="m-0 text-uppercase font-weight-bold">Để lại nhận xét</h4>
    </div>
    <div class="bg-white border border-top-0 p-4">
        <form method="POST" id="form-user-comment">
            @csrf
            <div class="form-group">
                <label for="message">Message *</label>
                <textarea id="comment" name="comment" cols="30" rows="5" class="form-control"></textarea>
                <input type="hidden" value="{{$detailPost->id}}" name="id" id="id">
            </div>
            <div class="form-group mb-0">
                <button type="submit"
                    class="btn btn-primary font-weight-semi-bold py-2 px-3">Gửi</button>
            </div>
        </form>
    </div>
</div>

