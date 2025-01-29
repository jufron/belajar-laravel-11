<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

    <div class="container my-5">
        <div class="row" id="data-item">

        </div>

        <div id="loading" class="my-2" style="display: none;">Loading...</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script>
        let nextCursor = '{{ route('fetch-user') }}';
        const postContainer = document.getElementById('data-item');
        const loadingIndicator = document.getElementById('loading');
        let isLoading = false; // Tambahkan flag untuk mencegah multiple request
        let number = 1;
        // Fungsi untuk mengambil data
        async function loadPosts() {
            if (!nextCursor || isLoading) return; // Cegah eksekusi ganda

            isLoading = true;
            loadingIndicator.style.display = 'block';

            try {
                const response = await fetch(nextCursor);
                const data = await response.json();

                // Render posts ke dalam container
                data.data.forEach(user => {
                    const element = `
                        <div class="col-md-4 my-4">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">${number++}</li>
                                        <li class="list-group-item">${user.name}</li>
                                        <li class="list-group-item">${user.email}</li>
                                        <li class="list-group-item">${user.created_at}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    `;
                    postContainer.innerHTML += element;
                });

                // Perbarui cursor
                nextCursor = data.next_cursor;
            } catch (error) {
                console.error('Error fetching posts:', error);
            } finally {
                isLoading = false; // Reset flag
                loadingIndicator.style.display = 'none';
            }
        }

        // Fungsi debounce untuk membatasi eksekusi
        function debounce(func, delay) {
            let timer;
            return function (...args) {
                clearTimeout(timer);
                timer = setTimeout(() => func.apply(this, args), delay);
            };
        }

        // Tambahkan event listener untuk infinite scroll
        window.addEventListener(
            'scroll',
            debounce(() => {
                if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) {
                    loadPosts();
                }
            }, 200) // Eksekusi setelah jeda 200ms
        );

        // Muat data pertama kali
        loadPosts();

    </script>
  </body>
</html>
