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
    let editFacultyId=0;
    // function
    addFacultyBtn.click(function () {
        resetErrorFaculty();
        $(".new-faculty-form").trigger("reset");
    });
    faculty.on('click', '.edit-faculty', function () {
        resetErrorFaculty();
        editFacultyId=$(this).attr('editId');
        let urlUpdate=facultyPath+"/"+editFacultyId;
        callAjax(urlUpdate,null,getMethodForm)
            .done(data => {
                let faculty=data.data;
                $('.faculty-name').val(faculty.name);
                $('.faculty-description').val(faculty.description);
            })
    });

    faculty.on('click', '.new-faculty', function () {
        let facultyData = new FormData($('.new-faculty-form')[0]);
        callAjax(facultyPath,facultyData,newMethodForm)
            .done(data => {
                $('#newFacultyModal').modal('hide')
                alertSuccess(data.message);
                let facultyRow="<tr>"+fillFacultyToRowTable(data.data)+"</tr>";
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
        let facultyData = new FormData($('.edit-faculty-form')[0]);
        let urlUpdate = facultyPath + '/update/' + editFacultyId;
        callAjax(urlUpdate,facultyData,newMethodForm)
            .done(data => {
                $('#editFacultyModal').modal('hide');
                let facultyRow=fillFacultyToRowTable(data.data);
                $(".edit-faculty[editId="+editFacultyId+"]").parents('tr').html(facultyRow);
                alertSuccess(data.message);
                countStt();
            })
            .fail(data => {
                const errors = data.responseJSON.errors;
                showErrorFaculty(errors);
            });
    });
    faculty.on('click', '.delete-faculty', function () {
      let facultyId = $(this).attr('deleteId');
      let urlDelete = facultyPath + "/"+facultyId;
        destroyResource(urlDelete) .then(data => {
            alertSuccess(data.message);
            $(this).parents('tr').remove();
        })
            .catch(data => {
                alertError(data.message);
            });
    });

    //fill data to modal

});
