
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

function searchResource(data, url) {
    return $.ajax(
        {
            url: url,
            type: 'get',
            dataType: "JSON",
            data: data
        });
}
