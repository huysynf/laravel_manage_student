alertSuccess = (message) => {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: message,
        showConfirmButton: true,
        confirmButtonText: 'ok'
    });
};

function alertError(message) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...:',
        text: message,
    })
}

//curd resource

function callAjax(url, data = "", type = 'get') {
    return $.ajax({
        url: url,
        type: type,
        data: data,
        processData: false,
        contentType: false,
    });
}

destroyResource = (url) => {
    return new Promise(((resolve, reject) => {
        Swal.fire({
            title: 'Xác nhận xóa?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa ',
            cancelButtonText: 'Hủy bỏ'
        }).then((result) => {
            if (result.value) {
                callAjax(url, null, 'delete')
                    .done(data => {
                        resolve(data);
                    })
                    .fail(data => {
                        reject(data);
                    });
            }
        });
    }))
};

//count row table
function countStt() {
    let index = 1;
    $("tr td strong").each(function () {
        $(this).text(index);
        index++;

    });

}

//faculty error function
function resetErrorFaculty() {
    $('.nameError').html('');
    $('.descriptionError').html('');
}

function showErrorFaculty(errors) {
    (errors.name) ? $('.nameError').html(errors.name[0]) : "";
    (errors.description) ? $('.descriptionError').html(errors.description[0]) : "";

}

//subject error
function resetErrorSubject() {
    $('.name-error').html('');
    $('.lesson-error').html('');
    $('.description-error').html('');
}

function showErrorSubject(errors) {
    (errors.name) ? $('.name-error').html(errors.name[0]) : "";
    (errors.lesson) ? $('.lesson-error').html(errors.lesson[0]) : "";
    (errors.description) ? $('.description-error').html(errors.description[0]) : "";
}

//classroom
function arrayOjectParseToNameP(data) {
    let html = "";
    data.forEach(item => {
        html += `<p>${item.name}<p/>`;
    });
    return html;
}

//show image when chose
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.image-show').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(".image-input").change(function () {
    readURL(this);
});

//user

function showErrorPassword(errors) {
    (errors.oldPassword) ? $('.error-old-password').html(errors.oldPassword[0]) : "";
    (errors.password) ? $('.error-password').html(errors.password[0]) : "";
}

function resetErrorPassword() {
    $('.error-old-password').html('');
    $('.error-password').html('');
}

function resetErrorUser() {
    $('.error-name').html(' ');
    $('.error-email').html(' ');
    $('.error-image').html(' ');
    $('.error-password').html(' ');
    $('.error-password_confirmation').html('  ');
    $('.error-phone').html(' ');
    $('.error-role').html(' ');
}

function showErrorUser(errors) {
    (errors.name) ? $('.error-name').html(errors.name[0]) : "";
    (errors.email) ? $('.error-email').html(errors.email[0]) : "";
    (errors.image) ? $('.error-image').html(errors.image[0]) : "";
    (errors.password) ? $('.error-password').html(errors.password[0]) : "";
    (errors.password_confirmation) ? $('.error-password_confirmation').html(errors.password_confirmation[0]) : "";
    (errors.phone) ? $('.error-phone').html(errors.phone[0]) : "";
    (errors.role) ? $('.error-role').html(errors.role[0]) : "";

}

function fillUserToRowTable(user) {
    return `<tr>
        <td>
        <strong></strong>
        </td>
        <td>
        <img src="/images/users/${user.image}" alt=""
        style="max-width: 50px;max-height: 50px;" width="100%" height="100%"
        alt="${user.id}">
            </td>
            <td>
            ${user.name}
    </td>
        <td class="d-flex">
            <button class="btn btn-outline-primary btn-circle edit-user"
        title="Cập nhật thông tin người dùng"
        data-toggle="modal"
        editId="${user.id}"
        data-target="#editUserModal">
            <i class="fa fa-edit text-dark"></i>
            </button>
            <button class="btn btn-outline-dark delete-user btn-circle" title="Xóa người dùng"
        deleteId="${user.id}"><i class="fas fa-trash text-danger"></i></button>
        <button class="btn btn-outline-success btn-circle  show-user" title="Chi tiết người dùng"
        data-toggle="modal"
        showId="${user.id}"
        data-target="#showUserModal"><i class="fas fa-info-circle text-primary"></i>
            </button>
            <button class="btn btn-outline-primary  btn-circle change-user-password " title="Đổi mật khẩu"
        data-toggle="modal"
        userId="${user.id}"
        data-target="#setPasswordModal">
            <i class="fas fa-key text-warning"></i></button>
        </td>
       </tr>
   `;

}

