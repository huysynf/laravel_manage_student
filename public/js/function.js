function alertSuccess(message, reload = 0) {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: message,
        showConfirmButton: true,
        confirmButtonText: 'ok'
    })
        .then((result) => {
            if (result.value) {
                if (reload == 0) {
                    location.reload();
                }
            }
        })
}

function alertError(message) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...:',
        text: message,
    })
}

//curd resource

function callAjax( url,data="",type='get') {
    return $.ajax({
        url: url,
        type:type,
        data: data,
        processData: false,
        contentType: false,
    });
}
function destroyResource(url) {
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
            callAjax(url,null,'delete')
                .done(response => {
                    alertSuccess(response.message);
                })
                .fail(error => {
                    alertError(error.message);
                });
        }
    });
}

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
function resetErrorPassword(errors) {
    $('.error-old-password').html('');
    $('.error-password').html('') ;
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


