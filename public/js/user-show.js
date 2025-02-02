$(document).ready(function() {
    const modalUserShow = document.getElementById('userShowModal');
    const modalContainerContent = document.getElementById('container-show-user');

    $(document).on('click', '#buttonShow', function () {
        const modalShow = new bootstrap.Modal(modalUserShow);
        modalShow.show();

        renderLoading(true);

        $.ajax({
            url: $(this).attr('data-url'),
            method: 'GET',
            success: function(response) {
                renderLoading(false);
                renderHtml(response.data);
            },
            error: function(xhr) {
                renderLoading(false);
                const errors = xhr.responseJSON.errors;
                console.log(errors);
            }
        });
    });

    function renderHtml (data) {
        const element = `
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Nama ${data.name}</li>
                <li class="list-group-item">AEmail ${data.email}</li>
                <li class="list-group-item">Created At ${data.created_at}</li>
                <li class="list-group-item">Updated At ${data.updated_at}</li>
            </ul>
        `;
        modalContainerContent.innerHTML = element;
    }

    // todo render loading
    function renderLoading (state) {
        const element = `
            <p class="placeholder-glow">
                <span class="placeholder" style="width: 70%"></span>
                <span class="placeholder" style="width: 90%"></span>
                <span class="placeholder" style="width: 50%"></span>
                <span class="placeholder" style="width: 70%"></span>
                <span class="placeholder" style="width: 90%"></span>
                <span class="placeholder" style="width: 50%"></span>
                <span class="placeholder" style="width: 70%"></span>
                <span class="placeholder" style="width: 90%"></span>
                <span class="placeholder" style="width: 50%"></span>
            </p>
        `;
        if (state) {
            modalContainerContent.innerHTML = element;
        } else {
            modalContainerContent.innerHTML = '';
        }
    }
});
