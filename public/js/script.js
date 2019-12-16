$(function () {
    //setup ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //count row table
    countStt();

    //variable
    let idActionResource = 0;
    let urlResource = "";
    let dataResource = "";

    //faculty
    //valiable
    let faculty = $('#faculty');
    let newFacultyForm = $('.newfaculty-form');
    let editFacultyForm = $('.editfaculty-form');
    let addFacultyBtn = $('.add-faculty');
    let editFacultyBtn = $('.edit-faculty');
    let facultyPath = "/manage/faculties/";

    // function
    function resetError() {
        $('.nameError').html('');
        $('.descriptionError').html('');
    }

    function showErrorFaculty(errors) {
        (errors.name) ? $('.nameError').html(errors.name[0]) : "";
        (errors.description) ? $('.descriptionError').html(errors.description[0]) : "";
    }

    addFacultyBtn.click(function () {
        resetError();
    })
    editFacultyBtn.click(function (event) {
        idActionResource = $(this).attr('editId');
        resetError();
    });

    faculty.on('click', '.new-faculty', function () {
        dataResource = newFacultyForm.serialize();
        urlResource = '/manage/faculties';
        newResource(dataResource, urlResource)
            .done(response => {
                $('#newFacultyModal').modal('hide')
                isSuccess(response.status) ? alertSuccess(response.message) : "";
                countStt();
            })
            .fail(error => {
                const errors = error.responseJSON.errors;
                showErrorFaculty(errors);
            });
    });
    faculty.on('click', '.update-faculty', function () {
        dataResource = editFacultyForm.serialize();
        urlResource = facultyPath + idActionResource;
        updateResource(dataResource, urlResource)
            .done(response => {
                $('#newFacultyModal').modal('hide')
                isSuccess(response.status) ? alertSuccess(response.message) : "";
                countStt();
            })
            .fail(error => {
                const errors = error.responseJSON.errors;
                showErrorFaculty(errors);
            });
    });

    faculty.on('click', '.delete-faculty', function () {
        idActionResource = $(this).attr('deleteId');
        destroyResource(idActionResource, facultyPath);
    });
    //fill data to modal
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var name = button.data('name');
        var description = button.data('description');
        var modal = $(this);
        modal.find('.modal-body .name').val(name);
        modal.find('.modal-body .description').val(description);
    });


});
