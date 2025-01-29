<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link href="/css/css.css" rel="stylesheet"> 
</head>
<body>
    <div class="container">
        <h1>Edit Task</h1>
        <form action="/edit-task/{{$task->id}}" method="POST" class="form-container">
            @csrf
            @method('PUT')
            <div class="input-container">
                <input type="text" name="title" value="{{$task->title}}" class="input-field" required>
            </div>
            <div class="input-container">
                <textarea name="description" class="input-field" required>{{$task->description}}</textarea>
            </div>
            <div class="input-container">
                <input type="date" name="deadline" value="{{$task->deadline}}" class="input-field" required>
            </div>
            <button class="btn-submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
