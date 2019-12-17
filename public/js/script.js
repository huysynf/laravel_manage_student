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
    let searchMessage=$('.search-message');
    //faculty
    //valiable
    let faculty = $('#faculty');
    let newFacultyForm = $('.newfaculty-form');
    let editFacultyForm = $('.editfaculty-form');
    let addFacultyBtn = $('.add-faculty');
    let editFacultyBtn = $('.edit-faculty');
    let facultyPath = "/manage/faculties/";
    let facultySearch = $('.faculty-searchkey');

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

    facultySearch.on('keyup', function () {
        let searchKey = $(this).val().trim();
        searchPath = facultyPath + "search/" + searchKey;
        if(searchKey.length>0){
            searchResource(searchPath)
                .done(data => {
                    $('.pagination-container').hide();
                    const faculties = data.data;
                    searchMessage.html(data.message);
                    let facutyTable = fillFacultyToTableHtml(faculties);
                    $('tbody').html(facutyTable);
                    countStt();
                })
                .fail(error => {
                    searchMessage.html('');
                });
        }else {
            searchMessage.html('');
        }
        facultySearch.on('keydown',function () {
            if(searchKey.length<0){
                searchMessage.html('');
            }
        });

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
