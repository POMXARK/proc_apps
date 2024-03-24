<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <p>Добрый день, {{$stmt->name}}!</p>
        <p>Ответ по заявке:</p>
        <p>Номер: {{$stmt->id}}</p>
        <p>Сообщение: {{$stmt->message}}</p>
        <p>Комментарий: {{$stmt->comment}}</p>
    </div>
</body>
</html>
