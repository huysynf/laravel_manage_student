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
    let idAction = 0;
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
        $(".new-faculty-form").trigger("reset");
    });
    faculty.on('click', '.edit-faculty', function () {
        resetErrorFaculty();
        idAction=$(this).attr('editId');
        urlResource=facultyPath+"/"+idAction;
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
                let facultyRow=fillFacultyToRowTable(data.data);
                $('tbody').prepend(facultyRow);
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
        urlResource = facultyPath + '/update/' + idAction;
        callAjax(urlResource,dataResource,newMethodForm)
            .done(data => {
                $('#newFacultyModal').modal('hide');
                let facultyRow=fillFacultyToRowTable(data.data);
                $(".edit-faculty[editId="+idAction+"]").parents('tr').html(facultyRow);
                alertSuccess(data.message);
                countStt();
            })
            .fail(data => {
                const errors = data.responseJSON.errors;
                showErrorFaculty(errors);
            });
    });
    faculty.on('click', '.delete-faculty', function () {
        idAction = $(this).attr('deleteId');
        urlResource = facultyPath + "/"+idAction;
        destroyResource(urlResource) .then(data => {
            alertSuccess(data.message);
            $(this).parents('tr').remove();
        })
            .catch(data => {
                alertError(data.message);
            });;
    });

    //fill data to modal

});
