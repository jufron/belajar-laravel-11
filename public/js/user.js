$(document).ready(function() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const tableUser = $('#table-user');
    const modalUser = $('#userModal');

    const buttonReset = $('#reload');
    const buttonAdd = $('#tambah')
    const buttonModalSaveData = $('#saveUser');
    const buttonModalSaveDataLoading = $('#loading-button');

    // * input select filter month and year
    const formInputSelectMonth = $('#month');
    const formInputSelectYear = $('#year');

    // * input name, email, password, password-confirmation
    const formInputName = $('#name');
    const formInputEmail = $('#email');
    const formInputPassword = $('#password');
    const formInputConfirmPassword = $('#password_confirmation');

    // * text invalid
    const formInvalidTextName = $('#invalid-name');
    const formInvalidTextEmail = $('#invalid-email');
    const formInvalidTextPassword = $('#invalid-password');
    const formInvalidTextPasswordConfirmation = $('#invalid-password-confirm');

    let ajaxRequest;

    let datatable = tableUser.DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: tableUser.attr('data-url'),
            data: function(d) {
                // filter data
                if (formInputSelectMonth.val() !== null) {
                    d.month = formInputSelectMonth.val();
                }

                if (formInputSelectYear.val() !== null) {
                    d.year  = formInputSelectYear.val();
                }
            }
        },
        columns: [
            { data: 'centang', name: 'centang' },
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'intro', name: 'intro' },
            { data: 'action', name: 'action' },
        ],
        order: [[3, 'desc']],
        rowCallback: function(row, data) {
            // console.log(data);

            // add atribute
            $(row).attr('atribute-name', data.DT_RowData['data-url-find']);
            $(row).attr('atribute-name-two', data.DT_RowData['data-name']);
        }
    });

    // todo reset form
    function resetInput () {
        formInputName.val(null);
        formInputEmail.val(null);
        formInputPassword.val(null);
        formInputConfirmPassword.val(null);
    }

    // todo pop up
    function popup ({message = 'berhasil menambahkan'}) {
        Toastify({
            text: message,
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
              background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
            onClick: function(){}
        }).showToast();
    }

    // todo form validate error
    function resetValidateForm () {
        formInputName.removeClass('is-invalid');
        formInvalidTextName.text('');

        formInputEmail.removeClass('is-invalid');
        formInvalidTextEmail.text('');

        formInputPassword.removeClass('is-invalid');
        formInvalidTextPassword.text('');

        formInputConfirmPassword.removeClass('is-invalid');
        formInvalidTextPasswordConfirmation.text('');
    }

    function renderLoading (state) {
        if (state) {
            buttonModalSaveDataLoading.show();
            buttonModalSaveData.disabled = true;
        } else {
            buttonModalSaveDataLoading.hide();
            buttonModalSaveData.disabled = false;
        }
    }

    // todo reload page when create and update or delete
    buttonReset.on('click', function () {
        formInputSelectMonth.val(null);
        formInputSelectYear.val(null);

        datatable.ajax.reload(null, false);
    });

    formInputSelectMonth.change(function () {
        datatable.ajax.reload(null, false); // false agar tetap di halaman yang sama
    });
    formInputSelectYear.change(function () {
        datatable.ajax.reload(null, false); // false agar tetap di halaman yang sama
    });

    // * ketika click row tr langsung checklist
    // tableUser.on('click', 'tr', function () {
    //     var checkbox = $(this).find('input[type="checkbox"]');
    //     if (checkbox.is(':checked')) {
    //          $(this).find('input[type="checkbox"]').prop('checked', false);
    //     } else {
    //         $(this).find('input[type="checkbox"]').prop('checked', true);
    //     }
    // });

    // * gimana caranya agar tombol dari hidden menjadi ada ketika salah satu checklist tapi ketika tidak checklist maka tombol kembali hilang
    // $('#delete-select').hide();
    // $('#table-user').on('change', 'input[type="checkbox"]', function () {
    //     // console.log('ada perubahan');
    //     var count = $('#table-user').find('input[type="checkbox"]:checked').length;
    //     if (count > 0) {
    //         $('#delete-select').show();
    //         $('#delete-select').attr('disabled', false);
    //     } else {
    //         $('#delete-select').hide();
    //         $('#delete-select').attr('disabled', true);
    //     }
    // });

    // ? create data
    buttonAdd.on('click', function () {
        var myModal = new bootstrap.Modal(modalUser);
        myModal.show();
    });

    renderLoading(false);
    buttonModalSaveData.on('click', function () {
        renderLoading(true);
        resetValidateForm();

        const formData = {
            name: formInputName.val() ?? '',
            email: formInputEmail.val() ?? '',
            password: formInputPassword.val() ?? '',
            password_confirmation: formInputConfirmPassword.val() ?? '',
        };

        ajaxRequest = $.ajax({
            url: $(this).attr('data-url'),
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            method: 'POST',
            data: formData,
            success: function(response) {
                renderLoading(false);

                resetInput();
                popup({message: response.message});

                modalUser.modal('hide');
                datatable.ajax.reload(null, false); // false agar tetap di halaman yang sama
            },
            error: function(xhr) {
                renderLoading(false);
                const errors = xhr.responseJSON.errors;

                errors.name ? formInputName.addClass('is-invalid') : '';
                formInvalidTextName.text(errors.name ? errors.name[0] : '');

                errors.email ? formInputEmail.addClass('is-invalid') : '';
                formInvalidTextEmail.text(errors.email ? errors.email[0] : '');

                errors.password ? formInputPassword.addClass('is-invalid') : '';
                formInvalidTextPassword.text(errors.password ? errors.password[0] : '');

                errors.password_confirmation ? formInputConfirmPassword.addClass('is-invalid') : '';
                formInvalidTextPasswordConfirmation.text(errors.password_confirmation ? errors.password_confirmation[0] : '');
            }
        });
    });

    // * Batalkan AJAX saat modal ditutup
    modalUser.on('hidden.bs.modal', function() {
        if (ajaxRequest) {
            ajaxRequest.abort();
            console.log("AJAX dibatalkan karena modal ditutup.");
        }
    });

    // ? delete data where select
    $('#delete-select').on('click', function () {
        const selectedData = [];

        $('#checkbox-user:checked').each(function () {
            selectedData.push($(this).val());
        });

        console.log(selectedData);
    });
});
