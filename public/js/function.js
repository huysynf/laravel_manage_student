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
        processData: false,
        contentType: false,
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

function searchResource( url) {
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
