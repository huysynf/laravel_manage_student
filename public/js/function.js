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
