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
    let getMethodForm = 'get';
    let newMethodForm = 'post';
    //faculty
    //variable
    let faculty = $('#faculty');
    let addFacultyBtn = $('.add-faculty');
    let facultyPath = "/manage/faculties";
    // function
    addFacultyBtn.click(function () {
        resetErrorFaculty();
    });
    faculty.on('click', '.edit-faculty', function () {
        resetErrorFaculty();
        idAction = $(this).attr('editId');
        urlResource = facultyPath + "/" + idAction;
        callAjax(urlResource, null, getMethodForm)
            .done(data => {
                let faculty = data.data;
                $('.faculty-name').val(faculty.name);
                $('.faculty-description').val(faculty.description);
            })
    });

    faculty.on('click', '.new-faculty', function () {
        dataResource = new FormData($('.new-faculty-form')[0]);
        callAjax(facultyPath, dataResource, newMethodForm)
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
        urlResource = facultyPath + '/update/' + idAction;
        callAjax(urlResource, dataResource, newMethodForm)
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
        idAction = $(this).attr('deleteId');
        urlResource = facultyPath + "/" + idAction;
        destroyResource(urlResource);
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
        callAjax(subjectPath, dataResource, newMethodForm)
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
        idAction = $(this).attr('editId');
        urlResource = subjectPath + "/" + idAction;
        callAjax(urlResource, null, getMethodForm)
            .done(data => {
                let subject = data.data;
                $('.subject-name').val(subject.name);
                $('.subject-lesson').val(subject.lesson);
                $('.subject-description').val(subject.description);
            })
    });
    subject.on('click', '.update-subject', function () {
        dataResource = new FormData($('.edit-subject-form')[0]);
        urlResource = subjectPath + "/update/" + idAction;
        callAjax(urlResource, dataResource, newMethodForm)
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
        idAction = $(this).attr('deleteId');
        urlResource = subjectPath + "/" + idAction;
        destroyResource(urlResource);
    });

//classroom
    $('.classroom-select-faculty').select2();
    $('.classroom-select-subject').select2();

    let classroom = $('#classroom');
    let classroomPath = "/manage/classrooms";

    classroom.on('click', '.delete-classroom', function () {
        idAction = $(this).attr('deleteId');
        urlResource = classroomPath + "/" + idAction;
        destroyResource(urlResource);
    });
    classroom.on('click', '.show-classroom', function () {
        idAction = $(this).attr('showId');
        urlResource = classroomPath + "/" + idAction;
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

    //student

    let student = $('#student');
    let studentPath = "/manage/students/";
    $('.student-select-classroom').select2();
    student.on('click', '.delete-student', function () {
        idAction = $(this).attr('deleteId');
        urlResource = studentPath + idAction;
        destroyResource(urlResource);
    });

    student.on('click', '.show-student', function () {
        idAction = $(this).attr('showId');
        urlResource = studentPath + idAction;
        callAjax(urlResource)
            .done(data => {
                let student = data.data;
                $('.student-name').html(student.name);
                $('.student-address').html(student.address);
                $(' .student-gender').html((student.gender == 0) ? 'Nam' : 'Nữ');
                $(' .student-image').attr('src', '/images/students/' + student.image);
                let classrooms = (student.classrooms.length > 0) ? arrayOjectParseToNameP(student.classrooms) : 'Không có';
                $('.student-classroom').html(classrooms);
                $(' .student-birthday').html(student.birthday);
                $('.student-phone').html(student.phone);

            })
    });
    //user
    let user = $('#user');
    let addUserBtn = $('.add-user');
    let userPath = "/manage/users";
    // function
    addUserBtn.click(function () {
        resetErrorUser();
    });
    user.on('click', '.new-user', function () {
        $("#new-user-form").trigger("reset");
        dataResource = new FormData($('#new-user-form')[0]);
        callAjax(urlResource, dataResource, 'post')
            .done(data => {
                $('#newUserModal').modal('hide');
                let userRow = fillUserToRowTable(data.data);
                $('tbody').prepend(userRow);
                countStt();
            })
            .fail(data => {
                const errors = data.responseJSON.errors;
                resetErrorUser();
                showErrorUser(errors);
            });
    });
    user.on('click', '.edit-user', function () {
        resetErrorUser();
        idAction = $(this).attr('editId');
        urlResource = userPath + "/" + idAction;
        callAjax(urlResource)
            .done(response => {
                let user = response.data;
                $('.user-name').val(user.name);
                $('.user-email').val(user.email);
                $('.user-phone').val(user.phone);
                $('.user-image').attr('src', '/images/users/' + user.image);
                $('.role-user').val(user.role);
            })
    });

    $('body').on('click', '.show-user', function () {
        idAction = $(this).attr('showId');
        urlResource = userPath + '/' + idAction;
        callAjax(urlResource)
            .done(response => {
                let user = response.data;
                $('.user-name').html(user.name);
                $('.user-email').html(user.email);
                $('.user-phone').html(user.phone);
                $('.user-image').attr('src', '/images/users/' + user.image);
                let role = "người dùng";
                if (user.role == 2) {
                    role = "nhân viên";
                }
                if (user.role == 3) {
                    role = "Quản trị";
                }
                $('.user-role').html(role);
            })
    });
    user.on('click', '.update-user', function () {
        dataResource = new FormData($('#update-user-form')[0]);
        urlResource = userPath + '/update/' + idAction;
        callAjax(urlResource, dataResource, 'post')
            .done(data => {
                $('#editUserModal').modal('hide')
                alertSuccess(data.message);
                let userRow = fillUserToRowTable(data.data);
                if(($('.edit-user').attr('editId'))==idAction){
                    $(this).prepend('abcd');
                    console.log('html');
                };
                countStt();
            })
            .fail(data => {
                const errors = data.responseJSON.errors;
                showErrorUser(errors);
            });
    });

    user.on('click', '.delete-user', function () {
        idAction = $(this).attr('deleteId');
        urlResource = userPath + "/" + idAction
        destroyResource(urlResource)
            .then(data => {
                alertSuccess(data.message);
                $(this).parents('tr').remove();
            })
            .catch(data => {
                alertError(data.message);
            });

    });
    $('body').on('click', '.change-user-password', function () {
        idAction = $(this).attr('userId');
        resetErrorPassword();
    });
    user.on('click', '.set-password', function () {
        $("#set-password-form").trigger("reset");
        dataResource = new FormData($('#set-password-form')[0]);
        urlResource = userPath + "/set-password/" + idAction;
        callAjax(urlResource, dataResource, newMethodForm)
            .done(data => {
                $('#changePasswordModal').modal('hide')
                alertSuccess(data.message,);
                countStt();
            })
            .fail(data => {
                const errors = data.responseJSON.errors;
                resetErrorUser();
                showErrorUser(errors);
            });
    });
    $('body').on('click', '.change-password', function () {
        dataResource = new FormData($('#change-password-form')[0]);
        urlResource = userPath + "/change-password/" + idAction;
        callAjax(urlResource, dataResource, newMethodForm)
            .done(data => {
                $('#changeUserPasswordModal').modal('hide')
                alertSuccess(data.message);
            })
            .fail(data => {
                const errors = data.responseJSON.errors;
                resetErrorPassword();
                showErrorPassword(errors);

            });
    })


});
