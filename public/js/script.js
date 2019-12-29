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
    //faculty
    //variable
    let faculty = $('#faculty');
    let addFacultyBtn = $('.add-faculty');
    let facultyPath = "/manage/faculties";
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
        let facultyData = new FormData($('.edit-faculty-form')[0]);
        let urlUpdate = facultyPath + '/update/' + editFacultyId;
        callAjax(urlUpdate,facultyData,newMethodForm)
            .done(data => {
                $('#editFacultyModal').modal('hide');
                let facultyRow=fillFacultyToRowTable(data.data);
                $(".edit-faculty[editId="+editFacultyId+"]").parents('tr').replaceWith(facultyRow);
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
    //subject
    //variable
    let subject = $('#subject');
    let addSubjectBtn = $('.add-subject');
    let editSubjectBtn = $('.edit-subject');
    let subjectPath = "/manage/subjects";
    // function
    addSubjectBtn.click(function () {
        resetErrorSubject();
    });
    subject.on('click', '.new-subject', function () {
        dataResource = new FormData($('.new-subject-form')[0]);
        callAjax(subjectPath,dataResource,newMethodForm)
            .done(data => {
                $('#newsubjectModal').modal('hide');
                alertSuccess(data.message);
                countStt();
            })
            .fail(data => {
                const errors = data.responseJSON.errors;
                resetErrorSubject();
                showErrorSubject(errors);
            });
    });
    subject.on('click', '.edit-subject', function () {
        resetErrorSubject();
        idActionResource=$(this).attr('editId');
        urlResource=subjectPath+"/"+idActionResource;
        callAjax(urlResource,null,getMethodForm)
            .done(data => {
              let subject=data.data;
                $('.subject-name').val(subject.name);
                $('.subject-lesson').val(subject.lesson);
                $('.subject-description').val(subject.description);
            })
    });
    subject.on('click', '.update-subject', function () {
        dataResource = new FormData($('.edit-subject-form')[0]);
        urlResource = subjectPath + "/update/" + idActionResource;
        callAjax(urlResource,dataResource,newMethodForm)
            .done(data => {
                $('#editSubjectModal').modal('hide')
                alertSuccess(data.message);
                countStt();
            })
            .fail(data => {
                const errors = data.responseJSON.errors;
                resetErrorSubject();
                showErrorSubject(errors);
            });
    });

    subject.on('click', '.delete-subject', function () {
        idActionResource = $(this).attr('deleteId');
        urlResource=subjectPath + "/"+idActionResource;
        destroyResource(urlResource);
    });

//classroom
    $('.classroom-select-faculty').select2();
    $('.classroom-select-subject').select2();

    let classroom = $('#classroom');
    let classroomPath = "/manage/classrooms";

     classroom.on('click', '.delete-classroom', function () {
        idActionResource = $(this).attr('deleteId');
        urlResource=classroomPath+"/"+idActionResource;
        destroyResource(urlResource)
            .then(data => {
                alertSuccess(data.message);
                $(this).parents('tr').remove();
            })
            .catch(data => {
                alertError(data.message);
            });

    });
    classroom.on('click','.show-classroom',function () {
        idActionResource=$(this).attr('showId');
        urlResource=classroomPath+"/"+idActionResource;
        callAjax(urlResource)
            .done(data => {
                let classroom = data.data;
                $('.classroom-name').html(classroom.name);
                $('.classroom-description').html(classroom.description);
                $('.classroom-member').html(classroom.member);
                $('.classroom-faculty').html(classroom.faculty.name);
                $('.classroom-subject').html(classroom.subject.name);
            })
    });


});

