<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$result->title}}</title>
</head>

<body>
    {!! QrCode::size(250)->generate($result->synopsis_url) !!}
</body>

</html>