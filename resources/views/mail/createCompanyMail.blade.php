<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create New Company</title>
</head>
<body>
    <h1>Company {{ $company->name }}</h1>
    <p>Was added successfully at {{ $company->created_at }}.</p>
</body>
</html>