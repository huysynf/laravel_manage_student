const DELETE_STATUS_CODE = 204;
const SUCCESS_STATUS_CODE = 200;
const CREATE_STATUS_CODE = 201;
const TIME_TO_SEARCH = 2000;

//function
function isSuccess(status) {
    return status == SUCCESS_STATUS_CODE;
}

function isCreated(status) {
    return status == CREATE_STATUS_CODE;
}

function isDeleted(status) {
    return status == DELETE_STATUS_CODE;
}

//function alert eror
function alertSuccess(message,reload=0) {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: message,
        showConfirmButton: true,
        confirmButtonText: 'ok'
    })
        .then((result) => {
            if (result.value ) {
                  if(reload==0){
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
function getResource(url) {
    return $.ajax({
        url: url,
        type: "get",
    });
}

function newResource(data, url) {
    return $.ajax({
        url: url,
        type: "post",
        data: data,
        processData: false,
        contentType: false,
    });
}

function updateResource(data, url) {
    return $.ajax({
        url: url,
        type: "PUT",
        data: data,
    });
}
function deleteResource(id, url) {
    return $.ajax(
        {
            url: url + id,
            type: 'delete',
            dataType: "JSON",
            data: {"id": id,}
        });
}

function destroyResource(id, url) {
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
            deleteResource(id, url)
                .done(response => {
                    if (isDeleted(response.status)) {
                        alertSuccess(response.message);
                    }
                })
                .fail(error => {
                    alertError(error.message);
                });
        }
    });
}

function searchResource(url) {
    return $.ajax(
        {
            url: url,
            type: 'get',
            dataType: "JSON",
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

//fetch data to table
function fillFacultyToTableHtml(data) {
    let tableHTML = "";
    data.forEach(item => {
        tableHTML += ` <tr>
                        <td>
                            <strong></strong>
                        </td>
                        <td>
                            ${item.name}
                        </td>
                        <td>${item.description}</td>
                        <td>
                            <button  class="btn btn-primary edit-faculty" title="Cập nhật thông tin khoa"
                                    editId="${item.id}"
                                    data-toggle="modal"
                                    data-target="#editModal"
                                    data-name="${item.name}"
                                    data-description="${item.description}"
                                    data-id="${item.id}"
                                ><i
                                    class="fa fa-edit text-white"></i>
                            </button>
                            <button class="btn btn-dark delete-faculty" title="Xóa nhật khoa"
                               deleteId="${item.id}"><i class="fas fa-trash text-danger"></i></button>
                        </td>
                    </tr>`;
    });
    return tableHTML;
}

function fillSubjectToTableHtml(data) {
    let tableHTML = "";
    data.forEach(item => {
        tableHTML += ` <tr>
                        <td>
                            <strong></strong>
                        </td>
                        <td>
                            ${item.name}
                        </td>
                        <td>
                            ${item.lesson}
                        </td>
                        <td>${item.description}</td>
                        <td>
                            <button  class="btn btn-primary edit-subject" title="Cập nhật thông tin môn học"
                                    editId="${item.id}"
                                    data-toggle="modal"
                                    data-target="#editSubjectModal"
                                    data-name="${item.name}"
                                    data-lesson="${item.lesson}"
                                    data-description="${item.description}"
                                    data-id="${item.id}"
                                ><i
                                    class="fa fa-edit text-white"></i>
                            </button>
                            <button class="btn btn-dark delete-subject" title="Xóa môn học"
                               deleteId="${item.id}"><i class="fas fa-trash text-danger"></i></button>
                        </td>
                    </tr>`;
    });
    return tableHTML;
}

// function of user
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
