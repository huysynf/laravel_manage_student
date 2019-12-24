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
    let searchPath = "";
    //faculty
    //valiable
    let faculty = $('#faculty');
    let addFacultyBtn = $('.add-faculty');
    let editFacultyBtn = $('.edit-faculty');
    let facultyPath = "/manage/faculties";
    let facultySearch = $('.faculty-searchkey');
    // function
    function resetErrorFaculty() {
        $('.nameError').html('');
        $('.descriptionError').html('');
    }

    function showErrorFaculty(errors) {
        (errors.name) ? $('.nameError').html(errors.name[0]) : "";
        (errors.description) ? $('.descriptionError').html(errors.description[0]) : "";
    }

    addFacultyBtn.click(function () {
        resetErrorFaculty();
    })
    editFacultyBtn.click(function () {
        idActionResource = $(this).attr('editId');
        resetErrorFaculty();
    });

    faculty.on('click', '.new-faculty', function () {
        dataResource = new FormData($('.new-faculty-form')[0]);
        newResource(dataResource, facultyPath)
            .done(data => {
                $('#newFacultyModal').modal('hide')
                alertSuccess(data.message);
                countStt();
            })
            .fail(data => {
                const errors = data.responseJSON.errors;
                resetErrorFaculty();
                showErrorFaculty(errors);
            });
    });
    faculty.on('click', '.update-faculty', function () {
        dataResource = new FormData($('.edit-faculty-form')[0]);
        urlResource = facultyPath + '/update/' + idActionResource;
        newResource(dataResource, urlResource)
            .done(data => {
                $('#newFacultyModal').modal('hide');
                alertSuccess(data.message);
                countStt();
            })
            .fail(data => {
                const errors = data.responseJSON.errors;
                showErrorFaculty(errors);
            });
    });

    //fill data to modal

});
