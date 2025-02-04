$(document).ready(function() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    const modalDelete = document.getElementById('userDeleteModal');
    const modalDeleteBootstrap = new bootstrap.Modal(modalDelete);

    const loadingButtonDelete = document.getElementById('loading-button-delete');
    const deleteUserButton = document.getElementById('delete-user');

    let urlDelete;

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
        
        if (state) {
            loadingButtonDelete.style.display = 'inline-block';
            deleteUserButton.disabled = true;
        } else {
            loadingButtonDelete.style.display = 'none';
            deleteUserButton.disabled = false;
        }
    }

    $(document).on('click', '#buttonDelete', function () {
        modalDeleteBootstrap.show();
        renderLoading(false);
        urlDelete = $(this).attr('data-url');
    });

    $(document).on('click', '#delete-user', function (e) {
        e.preventDefault();
        renderLoading(true);

        $.ajax({
            url: urlDelete,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            method: 'DELETE',
            success: function(response) {
                renderLoading(false);
                modalDeleteBootstrap.hide();
                popup({message: response.message});
                window.location.reload();
            },
            error: function(xhr) {
                const errors = xhr.responseJSON.response;
                renderLoading(false);
                modalDeleteBootstrap.hide();
                console.log(errors);
                popup({message: errors, background: 'linear-gradient(to right, #ff4d4d, #ff9999)'});
            }
        });
    });
});
