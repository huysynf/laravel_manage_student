$(function () {
    //setup ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //select all
    $('.select-all').change(function () {
        $('.select-item').prop("checked", $(this).prop("checked"));
        $('.un-select-all').prop("checked", false);
    });

    $('.un-select-all').change(function () {
        if ($(this).prop("checked") == true) {
            $('.select-item').prop("checked", false);
            $('.select-all').prop("checked", false);
        }
    });

    $('.select-item').change(function () {
        $(this).prop("checked", $(this).prop("checked"));
        $('.un-select-all').prop("checked", false);
    });

    //count row table
     countIndexTableOfPage();

    //variable

    let getMethodForm = 'get';
    let postMethodForm = 'post';

    //faculty
    //variable

    let faculty = $('#faculty');
    let addFacultyBtn = $('.add-faculty');
    let facultyPath = "/manage/faculties";
    let facultyId = 0;

    // function
    addFacultyBtn.click(function () {
        resetErrorFaculty();
        $(".new-faculty-form").trigger("reset");
    });

    faculty.on('click', '.edit-faculty', function () {
        resetErrorFaculty();
        facultyId = $(this).attr('editId');
        let urlUpdate = facultyPath + "/" + facultyId;
        callAjax(urlUpdate, null, getMethodForm)
            .done(data => {
                let faculty = data.data;
                $('.faculty-name').val(faculty.name);
                $('.faculty-description').val(faculty.description);
            })
    });

    faculty.on('click', '.new-faculty', function () {
        let facultyData = new FormData($('.new-faculty-form')[0]);
        callAjax(facultyPath, facultyData, postMethodForm)
            .done(data => {
                $('#newFacultyModal').modal('hide');
                alertSuccess(data.message);
                let facultyRow = fillFacultyToRowTable(data.data);
                $('tbody').prepend(facultyRow);
                countIndexTableOfPage();
            })
            .fail(data => {
                let errors = data.responseJSON.errors;
                resetErrorFaculty();
                showErrorFaculty(errors);
            });
    });

    faculty.on('click', '.update-faculty', function () {
        let facultyData = new FormData($('.edit-faculty-form')[0]);
        let urlUpdate = facultyPath + '/update/' + facultyId;
        callAjax(urlUpdate, facultyData, postMethodForm)
            .done(data => {
                $('#editFacultyModal').modal('hide');
                let facultyRow = fillFacultyToRowTable(data.data);
                $(".edit-faculty[editId=" + facultyId + "]").parents('tr').replaceWith(facultyRow);
                alertSuccess(data.message);
                 countIndexTableOfPage();
            })
            .fail(data => {
                let errors = data.responseJSON.errors;
                showErrorFaculty(errors);
            });
    });

    faculty.on('click', '.delete-faculty', function () {
        facultyId = $(this).attr('deleteId');
        let urlDelete = facultyPath + "/" + facultyId;
        destroyResource(urlDelete)
            .then(data => {
                alertSuccess(data.message);
                $(this).parents('tr').remove();
                countIndexTableOfPage();
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
    let subjectPath = "/manage/subjects";
    let subjectId = 0;

    // function
    addSubjectBtn.click(function () {
        resetErrorSubject();
        $(".new-subject-form").trigger("reset");
    });

    subject.on('click', '.new-subject', function () {
        let subjectData = new FormData($('.new-subject-form')[0]);
        callAjax(subjectPath, subjectData, postMethodForm)
            .done(data => {
                $('#newsubjectModal').modal('hide');
                let subjectRow = fillSubjectToRowTable(data.data);
                $('tbody').prepend(subjectRow);
                alertSuccess(data.message);
                 countIndexTableOfPage();
            })
            .fail(data => {
                let errors = data.responseJSON.errors;
                resetErrorSubject();
                showErrorSubject(errors);
            });
    });

    subject.on('click', '.edit-subject', function () {
        resetErrorSubject();
        subjectId = $(this).attr('editId');
        let subjectUrl = subjectPath + "/" + subjectId;
        callAjax(subjectUrl)
            .done(data => {
                let subject = data.data;
                $('.subject-name').val(subject.name);
                $('.subject-lesson').val(subject.lesson);
                $('.subject-description').val(subject.description);
            })
    });

    subject.on('click', '.update-subject', function () {
        let subjectData = new FormData($('.edit-subject-form')[0]);
        let subjectUrl = subjectPath + "/update/" + subjectId;
        callAjax(subjectUrl, subjectData, postMethodForm)
            .done(data => {
                $('#editSubjectModal').modal('hide')
                let subjectRow = fillSubjectToRowTable(data.data);
                $(".edit-subject[editId=" + subjectId + "]").parents('tr').replaceWith(subjectRow);
                alertSuccess(data.message);
                 countIndexTableOfPage();
            })
            .fail(data => {
                let errors = data.responseJSON.errors;
                resetErrorSubject();
                showErrorSubject(errors);
            });
    });

    subject.on('click', '.delete-subject', function () {
        subjectId = $(this).attr('deleteId');
        let subjectUrl = subjectPath + "/" + subjectId;
        destroyResource(subjectUrl)
            .then(data => {
                alertSuccess(data.message);
                $(this).parents('tr').remove();
                countIndexTableOfPage();
            })
            .catch(data => {
                alertError(data.message);
            });
    });

//classroom
    $('.classroom-select-faculty').select2();
    $('.classroom-select-subject').select2();

    let classroom = $('#classroom');
    let classroomPath = "/manage/classrooms";
    let classroomId = 0;

    classroom.on('click', '.delete-classroom', function () {
        classroomId = $(this).attr('deleteId');
        let ClassroomUrl = classroomPath + "/" + classroomId;
        destroyResource(ClassroomUrl)
            .then(data => {
                alertSuccess(data.message);
                $(this).parents('tr').remove();
                countIndexTableOfPage();
            })
            .catch(data => {
                alertError(data.message);
            });
    });

    classroom.on('click', '.show-classroom', function () {
        classroomId = $(this).attr('showId');
        let classroomUrl = classroomPath + "/" + classroomId;
        callAjax(classroomUrl)
            .done(data => {
                let classroom = data.data;
                $('.classroom-name').html(classroom.name);
                $('.classroom-description').html(classroom.description);
                $('.classroom-member').html(classroom.member);
                $('.classroom-faculty').html(classroom.faculty.name);
                $('.classroom-subject').html(classroom.subject.name);
                let classroomScheduleTable=fillClassroomScheduleToTable(classroom.classroom_shedule);
                $('.classroom-schedule').html(classroomScheduleTable);

            })
    });

    //student

    let student = $('#student');
    let studentPath = "/manage/students/";
    $('.student-select-classroom').select2();
    let studentId = 0;

    student.on('click', '.delete-student', function () {
        studentId = $(this).attr('deleteId');
        let studentUrl = studentPath + studentId;
        destroyResource(studentUrl)
            .then(data => {
                alertSuccess(data.message);
                $(this).parents('tr').remove();
                countIndexTableOfPage();
            })
            .catch(data => {
                alertError(data.message);
            });
    });

    student.on('click', '.show-student', function () {
        studentId = $(this).attr('showId');
        let studentUrl = studentPath + studentId;
        callAjax(studentUrl)
            .done(data => {
                let student = data.data;
                $('.student-name').html(student.name);
                $('.student-address').html(student.address);
                $(' .student-gender').html((student.gender == 1) ? 'Nam' : 'Nữ');
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
    $('.user-select-role').select2();
    let userId = 0;

    // function
    addUserBtn.click(function () {
        $("#new-user-form").trigger("reset");
        resetErrorUser();
    });

    user.on('click', '.new-user', function () {
        let userData = new FormData($('#new-user-form')[0]);
        callAjax(userPath, userData, postMethodForm)
            .done(data => {
                $('#newUserModal').modal('hide');
                alertSuccess(data.message);
                let userRow = fillUserToRowTable(data.data);
                $('tbody').prepend(userRow);
                 countIndexTableOfPage();
            })
            .fail(data => {
                let errors = data.responseJSON.errors;
                resetErrorUser();
                showErrorUser(errors);
            });
    });

    user.on('click', '.edit-user', function () {
        resetErrorUser();
        userId = $(this).attr('editId');
        let userUrl = userPath + "/" + userId;
        callAjax(userUrl)
            .done(data => {
                let user = data.data;
                $('.user-name').val(user.name);
                $('.user-email').val(user.email);
                $('.user-phone').val(user.phone);
                $('.user-image').attr('src', '/images/users/' + user.image);
                $('.user-role').val(user.role.id);
            })
    });

    $('body').on('click', '.show-user', function () {
        userId = $(this).attr('showId');
        let userUrl = userPath + '/' + userId;
        callAjax(userUrl)
            .done(data => {
                let user = data.data;
                $('.user-name').html(user.name);
                $('.user-email').html(user.email);
                $('.user-phone').html(user.phone);
                $('.user-image').attr('src', '/images/users/' + user.image);
                $('.user-role').html(user.role.name);
            })
    });

    user.on('click', '.update-user', function () {
        let userData = new FormData($('#update-user-form')[0]);
        let userUrl = userPath + '/update/' + userId;
        callAjax(userUrl, userData, postMethodForm)
            .done(data => {
                $('#editUserModal').modal('hide');
                alertSuccess(data.message);
                let userRow = fillUserToRowTable(data.data);
                $(".edit-user[editId=" + userId + "]").parents('tr').replaceWith(userRow);
                 countIndexTableOfPage();
            })
            .fail(data => {
                let errors = data.responseJSON.errors;
                showErrorUser(errors);
            });
    });

    user.on('click', '.delete-user', function () {
        userId = $(this).attr('deleteId');
        let userUrl = userPath + "/" + userId;
        destroyResource(userUrl)
            .then(data => {
                alertSuccess(data.message);
                $(this).parents('tr').remove();
                countIndexTableOfPage();
            })
            .catch(data => {
                alertError(data.message);
            });
    });

    user.on('click', '.set-password', function () {
        let passwordData = new FormData($('#set-password-form')[0]);
        let setPasswordUrl = userPath + "/set-password/" + userId;
        callAjax(setPasswordUrl, passwordData, postMethodForm)
            .done(data => {
                $('#setPasswordModal').modal('hide');
                alertSuccess(data.message,);
                 countIndexTableOfPage();
            })
            .fail(data => {
                let errors = data.responseJSON.errors;
                resetErrorUser();
                showErrorUser(errors);
            });
    });

    $('body').on('click', '.change-password', function () {
        let passwordData = new FormData($('#change-password-form')[0]);
        let changePasswordUrl = userPath + "/change-password/" + userId;
        callAjax(changePasswordUrl, passwordData, postMethodForm)
            .done(data => {
                $('#changeUserPasswordModal').modal('hide');
                alertSuccess(data.message);
            })
            .fail(data => {
                let errors = data.responseJSON.errors;
                resetErrorPassword();
                showErrorPassword(errors);
            });
    });

    //role
    let role = $('#role');
    let rolePath = '/manage/roles';
    let addRole = $('.add-role');
    let roleId = 0;
    $('.role-select-permission').select2();

    addRole.click(function () {
        $("#new-role-form").trigger("reset");
        resetErrorRole();
    });

    role.on('click', '.new-role', function () {
        resetErrorRole();
        let roleData = new FormData($('#new-role-form')[0]);
        callAjax(rolePath, roleData, postMethodForm)
            .done(data => {
                $('#newRoleModal').modal('hide');
                alertSuccess(data.message);
                let role = fillRoleToRowTable(data.data);
                $('tbody').prepend(role);
                 countIndexTableOfPage();
            })
            .fail(data => {
                let errors = data.responseJSON.errors;
                resetErrorRole();
                showErrorRole(errors);
            });
    });

    role.on('click', '.show-role', function () {
        roleId = $(this).attr('showId');
        let urlRole = rolePath + '/' + roleId;
        callAjax(urlRole)
            .done(data => {
                let role = data.data;
                $('.role-name').html(role.name);
                let permissions = arrayOjectParseToNameP(role.permissions)
                $('.permissions-box').html(permissions);
            })
    });

    role.on('click', '.delete-role', function () {
        roleId = $(this).attr('deleteId');
        let urlRole = rolePath + "/" + roleId;
        destroyResource(urlRole)
            .then(data => {
                alertSuccess(data.message);
                $(this).parents('tr').remove();
                countIndexTableOfPage();
            })
            .catch(data => {
                alertError(data.message);
            });
    });

    //permission
    let permission = $('#permission');
    let permissionPath = '/manage/permissions';
    let permissionId = 0;

    permission.on('click', '.edit-permission', function () {
        $('.error-name').html('');
        permissionId = $(this).attr('editId');
        let urlPermission = permissionPath + "/" + permissionId;
        callAjax(urlPermission)
            .done(data => {
                let permission = data.data;
                $('.permission-name').val(permission.name);
                $('.permission-slug').val(permission.slug);
            })
    });

    permission.on('click', '.update-permission', function () {
        let permissionData = new FormData($('#update-permission-form')[0]);
        let urlUpdate = permissionPath + '/update/' + permissionId;
        callAjax(urlUpdate, permissionData, postMethodForm)
            .done(data => {
                $('#editPermissionModal').modal('hide');
                alertSuccess(data.message);
                let permissionRow = fillPermissionToRowTable(data.data);
                $(".edit-permission[editId=" + permissionId + "]").parents('tr').replaceWith(permissionRow);
                 countIndexTableOfPage();
            })
            .fail(data => {
                let errors = data.responseJSON.errors;
                $('.error-name').html(errors.name[0]);
            });
    });

    //classroom schedule
    let classroomSchedule=$('#classroomSchedule');

    classroomSchedule.on('click','.delete-classroom-schedule',function () {
        let classroomScheduleId=$(this).attr('classroomScheduleId');
        let url='/manage/classroomschedules/'+classroomScheduleId;
        destroyResource(url)
            .then(data=>{
                alertSuccess(data.message);
                $(this).parent().remove();
            })
            .catch(data=>{
                alertError(data.message);
            });
    })
});

