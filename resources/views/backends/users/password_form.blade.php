<div class="form-group">
    <label for="">Mật khẩu mới</label>
    <input type="password" class="form-control " name="password"
           value="{{old('password')}}"
    >
    <span class="text-danger error-password"></span>
</div>
<div class="form-group">
    <label for="">Nhập lại mật khẩu</label>
    <input type="password" class="form-control " name="password_confirmation"
           value="{{old('password_confirmation')}}"
    >
    <span class="text-danger error-password_confirmation"></span>
</div>
