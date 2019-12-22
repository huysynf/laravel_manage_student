<div class="modal fade" id="changeUserPasswordModal" tabindex="-1" role="dialog"
     aria-labelledby="changeUserPasswordModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeUserPasswordModalTitle">Đổi mật khẩu <span
                        class="classromm-name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="change-password-form"
                  enctype="multipart/form-data">
                <div class="modal-body text-dark ">
                    @csrf
                    {{method_field('put')}}
                    <div class="form-group">
                        <label for="">Mật khẩu cũ</label>
                        <input type="password" class="form-control " name="oldpassword"
                               value="{{old('oldpassword')}}"
                        >
                        <span class="text-danger error-password"></span>
                    </div>
                    @include('backends.users.password_form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary change-password"><i
                            class="fas fa-pencil-alt">
                            Đổi mật khẩu
                        </i>
                    </button>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Trở về
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
