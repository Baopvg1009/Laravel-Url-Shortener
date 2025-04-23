<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>URL Shortener</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
          rel="stylesheet" >
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="text-center">URL Shortener</h3>
                </div>
                <div class="card-body">
                    <form id="shorten-form">
                        <div class="mb-3">
                            <label for="original_url" class="form-label">Enter URL to Shorten</label>
                            <input type="url" name="original_url" id="original_url" class="form-control" placeholder="https://Example.com" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Shorten URL</button>
                    </form>
                    <div id="result" class="mt-3" style="display: none;">
                        <h5>Shortened URL:</h5>
                        <a href="#" id="short_url" target="_blank" class="btn btn-link"></a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('shorten-form')
    .addEventListener('submit',function (event){
        event.preventDefault();

        const originalUrl = document.getElementById('original_url').value;

        fetch('{{route('url.short')}}',{
            method:'POST',
            headers:{
                'Content-Type':'application/json',
                'Accept':'application/json',
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },

            body:JSON.stringify({original_url:originalUrl})

        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            }).then(data => {
            const shortUrlElement = document.getElementById('short_url');
            console.log(data.short_url);
            shortUrlElement.href = data.short_url;
            shortUrlElement.textContent = data.short_url;
            document.getElementById('result').style.display = 'block';
        })


            .catch(error => {

                console.error('Error:', error);
                alert('An error occurred while shortening the URL.');
            });
    })
</script>
</body>
</html>
