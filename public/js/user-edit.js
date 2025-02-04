$(document).ready(function () {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    const modalEdit = document.getElementById('userEditModal');
    const modalEditBootstrap = new bootstrap.Modal(modalEdit);

    const formInputNameEdit = document.getElementById('name-edit');
    const formInputEmailEdit = document.getElementById('email-edit');
    const formInputPasswordEdit = document.getElementById('password-edit');
    const formInputConfirmPasswordEdit = document.getElementById('password_confirmation-edit');

    const formInvalidTextNameEdit = document.getElementById('invalid-name-edit');
    const formInvalidTextEmailEdit = document.getElementById('invalid-email-edit');
    const formInvalidTextPasswordEdit = document.getElementById('invalid-password-edit');
    const formInvalidPasswordConfirmationEdit = document.getElementById('invalid-password-confirm-edit');

    let urlUpdate;

    // todo pop up
    function popup ({
        message = 'berhasil menambahkan',
        background = 'linear-gradient(to right, #00b09b, #96c93d)'
    }) {
        Toastify({
            text: message,
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: background,
            },
            onClick: function(){}
        }).showToast();
    }

    function renderLoading (state) {
        const loadingButtonUpdate = document.getElementById('loading-button-update');
        const updateUserButton = document.getElementById('update-user');

        if (state) {
            loadingButtonUpdate.style.display = 'inline-block';
            updateUserButton.disabled = true;
        } else {
            loadingButtonUpdate.style.display = 'none';
            updateUserButton.disabled = false;
        }
    }

    $(document).on('click', '#buttonEdit', function () {
        modalEditBootstrap.show();

        renderLoading(true);

        const urlEdit = $(this).attr('data-url-edit');
        urlUpdate     = $(this).attr('data-url-update');

        $.ajax({
            url: urlEdit,
            method: 'GET',
            success: function(response) {
                renderLoading(false);

                showDataEdit(response.data);
            },
            error: function(xhr) {
                const errors = xhr.responseJSON.errors;
                popup({
                    message: 'gagal mengambil data',
                    background: 'linear-gradient(to right, #ff0000, #ff4d4d)'
                });
                console.log(errors);
            }
        });
    });

    function showDataEdit (data) {
        formInputNameEdit.value = data.name;
        formInputEmailEdit.value = data.email;
        formInputPasswordEdit.value = '';
        formInputConfirmPasswordEdit.value = '';
    }

    $(document).on('click', '#update-user', function () {
        renderLoading(true);
        const data = {
            name: formInputNameEdit.value ?? '',
            email: formInputEmailEdit.value ?? '',
            password: formInputPasswordEdit.value ?? '',
            password_confirmation: formInputConfirmPasswordEdit.value ?? '',
        };
        $.ajax({
            url: urlUpdate,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            method: 'Patch',
            data: data,
            success: function(response) {
                renderLoading(false);
                modalEditBootstrap.hide();
                popup({message: response.message});
                // reload page
                window.location.reload();
            },
            error: function(xhr) {
                const errors = xhr.responseJSON.errors;
                renderLoading(false);

                errors.name
                    ? formInputNameEdit.classList.add('is-invalid')
                    : formInputNameEdit.classList.remove('is-invalid');
                formInvalidTextNameEdit.textContent = errors.name ? errors.name[0] : '';

                errors.email
                    ? formInputEmailEdit.classList.add('is-invalid')
                    : formInputEmailEdit.classList.remove('is-invalid');
                formInvalidTextEmailEdit.textContent = errors.email ? errors.email[0] : '';

                errors.password
                    ? formInputPasswordEdit.classList.add('is-invalid')
                    : formInputPasswordEdit.classList.remove('is-invalid');
                formInvalidTextPasswordEdit.textContent = errors.password ? errors.password[0] : '';

                errors.password_confirmation
                    ? formInputConfirmPasswordEdit.classList.add('is-invalid')
                    : formInputConfirmPasswordEdit.classList.remove('is-invalid');
                formInvalidPasswordConfirmationEdit.textContent = errors.password_confirmation ? errors.password_confirmation[0] : '';

                console.log(errors);
            }
        });

    });

});
