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
    let searchMessage = $('.search-message');
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
        if (searchKey.length > 0) {
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
        } else {
            searchMessage.html('');
        }
        facultySearch.on('keydown', function () {
            if (searchKey.length < 0) {
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
    //subject
    //valiable
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
        if (searchKey.length > 0) {
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
        } else {
            searchMessage.html('');
        }
        subjectSearch.on('keydown', function () {
            if (searchKey.length < 0) {
                searchMessage.html('');
            }
        });

    });
    //fill data to modal
    $('#editSubjectModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var name = button.data('name');
        var description = button.data('description');
        var lesson = button.data('lesson');
        var modal = $(this);
        modal.find('.modal-body .name').val(name);
        modal.find('.modal-body .description').val(description);
        modal.find('.modal-body .lesson').val(lesson);
    });
    //user
    let user = $('#user');
    let addUserBtn = $('.add-user');
    let userPath = "/manage/users/";
    let userSearch = $('.user-searchkey');
    // function
    addUserBtn.click(function () {
        resetErrorUser();
    });
    user.on('click', '.new-user', function () {
        dataResource = new FormData($('#new-user-form')[0]);
        urlResource = '/manage/users';
        newResource(dataResource, urlResource)
            .done(data => {
                 $('#newUserModal').modal('hide');
                console.log(data);
               isCreated(data.status) ? alertSuccess(data.message) : "";
                countStt();
            })
            .fail(data => {
                const errors = data.responseJSON.errors;
                console.log(errors);
                showErrorUser(errors);
            });
    });
    user.on('click', '.edit-user', function () {
        resetErrorUser();
        idActionResource = $(this).attr('editId');
        urlResource = userPath + idActionResource;
        getResource(urlResource)
            .done(response => {
                let user = response.data;
                $('.user-name').val(user.name);
                $('.user-email').val(user.email);
                $('.user-phone').val(user.phone);
                $('.user-image').attr('src', '/images/users/' + user.image);
                $('.user-role').val(user.role);
            })
    });

    $('body').on('click', '.show-user', function () {
        idActionResource = $(this).attr('showId');
        urlResource = userPath + idActionResource;
        getResource(urlResource)
            .done(response => {
                let user = response.data;
                $('.user-name').html(user.name);
                $('.user-email').html(user.email);
                $('.user-phone').html(user.phone);
                $('.user-image').attr('src', '/images/users/' + user.image);
                let role = "người dùng";
                if (user.role == 1) {
                    role = "nhân viên";
                }
                if (user.role == 2) {
                    role = "Quản trị";
                }

                $('.user-role').html(role);
            })
    });
    user.on('click', '.update-user', function () {
        dataResource = new FormData($('#update-user-form')[0]);
        console.log(dataResource);
        urlResource ='/manage/users/update/'+idActionResource;
        newResource(dataResource,urlResource)
        .done(response => {
                $('#editUserModal').modal('hide')
                isSuccess(response.status) ? alertSuccess(response.message) : "";
                 countStt();
            })
            .fail(error => {
                console.log(error);
                const errors = error.responseJSON.errors;
                 showErrorUser(errors);
            });
    });

    user.on('click', '.delete-user', function () {
        idActionResource = $(this).attr('deleteId');
        destroyResource(idActionResource, userPath);
    });

    user.on('click', '.set-password', function () {
        dataResource = $('#set-password-form').serialize();
        urlResource = userPath + "setpassword/" + idActionResource;
        updateResource(dataResource, urlResource)
            .done(response => {
                $('#changePasswordModal').modal('hide')
                alertSuccess(response.message, 1);
                countStt();
            })
            .fail(error => {
                const errors = error.responseJSON.errors;
                showErrorUser(errors);
            });
    });
        //change password
    $('body').on('click', '.change-password', function () {
        dataResource = $('#change-password-form').serialize();
        urlResource = userPath + "changepassword/" + idActionResource;
        updateResource(dataResource, urlResource)
            .done(response => {
                $('#changeUserPasswordModal').modal('hide')
                alertSuccess(response.message, 1);
                countStt();
            })
            .fail(error => {
                const errors = error.responseJSON.errors;
                showErrorUser(errors);
            });
    });

    // userSearch.on('keyup', function () {
    //     let searchKey = $(this).val().trim();
    //     searchPath = facultyPath + "search/" + searchKey;
    //     if(searchKey.length>0){
    //         searchResource(searchPath)
    //             .done(data => {
    //                 $('.pagination-container').hide();
    //                 const faculties = data.data;
    //                 searchMessage.html(data.message);
    //                 let facutyTable = fillFacultyToTableHtml(faculties);
    //                 $('tbody').html(facutyTable);
    //                 countStt();
    //             })
    //             .fail(error => {
    //                 searchMessage.html('');
    //             });
    //     }else {
    //         searchMessage.html('');
    //     }
    //     facultySearch.on('keydown',function () {
    //         if(searchKey.length<0){
    //             searchMessage.html('');
    //         }
    //     });
    //
    // });
});
