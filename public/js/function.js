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
function  fillFacultyToRowTable(faculty) {
    return ` <td>
                <strong></strong>
            </td>
            <td>
                ${faculty.name}
            </td>
            <td>${faculty.description}</td>
            <td>
                <button class="btn btn-outline-primary btn-circle edit-faculty"
                        title="Cập nhật thông tin khoa"
                        editId="${faculty.id}"
                        data-toggle="modal"
                        data-target="#editFacultyModal"
                ><i class="fa fa-edit text-warning"></i>
                </button>
                <button class="btn btn-outline-dark delete-faculty btn-circle" title="Xóa nhật khoa"
                        deleteId="${faculty.id}"><i class="fas fa-trash text-danger"></i></button>
            </td>`;

}
