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
    let getMethodForm='get';
    let newMethodForm='post';
    let updateMethodForm='put';
    let deleteMethodForm='delete';
    //faculty
    //variable
    let faculty = $('#faculty');
    let addFacultyBtn = $('.add-faculty');
    let facultyPath = "/manage/faculties";
    let facultySearch = $('.faculty-searchkey');
    // function
    addFacultyBtn.click(function () {
        resetErrorFaculty();
    });
    faculty.on('click', '.edit-faculty', function () {
        resetErrorFaculty();
        idActionResource=$(this).attr('editId');
        urlResource=facultyPath+"/"+idActionResource;
        callAjax(urlResource,null,getMethodForm)
            .done(data => {
                let faculty=data.data;
                $('.faculty-name').val(faculty.name);
                $('.faculty-description').val(faculty.description);
            })
    });

    faculty.on('click', '.new-faculty', function () {
        dataResource = new FormData($('.new-faculty-form')[0]);
        callAjax(facultyPath,dataResource,newMethodForm)
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
        callAjax(urlResource,dataResource,newMethodForm)
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
    faculty.on('click', '.delete-faculty', function () {
        idActionResource = $(this).attr('deleteId');
        urlResource = facultyPath + "/"+idActionResource;
        destroyResource(urlResource);
    });

    //fill data to modal

});
