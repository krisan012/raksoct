<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task Notification</title>
</head>
<body>
<h1>{{ $task->title }}</h1>
<h1>{{ $task->notification }}</h1>
<h1>{{ $task->status }}</h1>
<h1>Assigned To: {{ $task->user->name }}</h1>
</body>
</html>
