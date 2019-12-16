const DELETE_STATUS_CODE = 204;
const SUCCESS_STATUS_CODE = 200;
const CREATE_STATUS_CODE = 201;

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
function alertSuccess(message) {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: message,
        showConfirmButton: true,
        confirmButtonText: 'ok'
    })
        .then((result) => {
            if (result.value) {
                location.reload();
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
        data: data
    });
}

function updateResource(data, url) {
    return $.ajax({
        url: url,
        type: "PUT",
        data: data
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

function searchResource(data, url) {
    return $.ajax(
        {
            url: url,
            type: 'get',
            dataType: "JSON",
            data: data
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
