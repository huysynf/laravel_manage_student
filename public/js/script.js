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
    //subject
    //variable
    let subject = $('#subject');
    let newSubjectForm = $('.newsubject-form');
    let editSubjectForm = $('.editsubject-form');
    let addSubjectBtn = $('.add-subject');
    let editSubjectBtn = $('.edit-subject');
    let subjectPath = "/manage/subjects/";
    let subjectSearch = $('.subject-searchkey');

    // function
    function resetErrorSubject() {
        $('.nameError').html('');
        $('.lessonError').html('');
        $('.descriptionError').html('');
    }

    function showErrorFacultySubject(errors) {
        (errors.name) ? $('.nameError').html(errors.name[0]) : "";
        (errors.name) ? $('.lessonError').html(errors.lesson[0]) : "";
        (errors.description) ? $('.descriptionError').html(errors.description[0]) : "";
    }

    addSubjectBtn.click(function () {
        resetErrorSubject();
    })
    editSubjectBtn.click(function (event) {
        idActionResource = $(this).attr('editId');
        showErrorFacultySubject();
    });

    subject.on('click', '.new-subject', function () {
        dataResource = newSubjectForm.serialize();
        urlResource = '/manage/subjects';
        newResource(dataResource, urlResource)
            .done(response => {
                $('#newsubjectModal').modal('hide');
                isCreated(response.status) ? alertSuccess(response.message) : "";
                countStt();
            })
            .fail(error => {
                const errors = error.responseJSON.errors;
                showErrorFacultySubject(errors);
            });
    });
    subject.on('click', '.update-subject', function () {
        dataResource = editSubjectForm.serialize();
        urlResource = subjectPath + idActionResource;
        updateResource(dataResource, urlResource)
            .done(response => {
                $('#newsubjectModal').modal('hide')
                isSuccess(response.status) ? alertSuccess(response.message) : "";
                countStt();
            })
            .fail(error => {
                const errors = error.responseJSON.errors;
                showErrorFaculty(errors);
            });
    });

    subject.on('click', '.delete-faculty', function () {
        idActionResource = $(this).attr('deleteId');
        destroyResource(idActionResource, facultyPath);
    });

    subjectSearch.on('keyup', function () {
        let searchKey = $(this).val().trim();
        searchPath = subjectPath + "search/" + searchKey;
        if(searchKey.length>0){
            searchResource(searchPath)
                .done(data => {
                    $('.pagination-container').hide();
                    const subjects = data.data;
                    console.log(subjects);
                    searchMessage.html(data.message);
                    let subjectTable = fillSubjectToTableHtml(subjects);
                    $('tbody').html(subjectTable);
                    countStt();
                })
                .fail(error => {
                    searchMessage.html('');
                });
        }else {
            searchMessage.html('');
        }
        subjectSearch.on('keydown',function () {
            if(searchKey.length<0){
                searchMessage.html('');
            }
        });

    });

});
