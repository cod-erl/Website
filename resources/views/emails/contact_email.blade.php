<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Contact Us') }}</div>

                <div class="container mail_body">
                    <p>Sender: {{$contact['name']}}</p>
                   <p>Sender: {{$contact['email']}}</p>
                   <p>Sender: {{$contact['message']}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
    
</body>
</html>
