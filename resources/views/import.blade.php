<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Progress</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <h1>Import Progress</h1>
    <span
        data-url-import=""="{{ route('import') }}"
        >
    </span>
    <progress id="progressBar" value="0" max="100"></progress>
    <p id="statusText">Status: Pending</p>

    <script>
        // ambil 2 url simpan di 2 variabel
        const urlImport = document.querySelector('span[data-url-import]').getAttribute('data-url-import');

        function checkProgress(batchId) {
            axios.get('/progress/' + batchId)
                .then(response => {
                    document.getElementById('progressBar').value = response.data.progress;
                    document.getElementById('statusText').innerText = 'Status: ' + response.data.status;

                    if (response.data.status === 'completed' || response.data.status === 'failed') {
                        clearInterval(progressInterval);
                    }
                });
        }

        // Simpan batch ID setelah import
        let batchId = null;

        // Simulasi submit form
       axios.post(urlImport, {
            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        })
        .then(response => {
            console.log(response);
            batchId = response.data.batch_id;
            progressInterval = setInterval(() => checkProgress(batchId), 2000);
        });
    </script>
</body>
</html>
