<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link href="/css/css.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        @auth
        <div class="auth-section">
            <p>Logged in as {{ auth()->user()->name }}</p>
            <form action="/logout" method="POST">
                @csrf
                <button class="btn-logout">Logout</button>
            </form>
        </div>

        <div class="task-section">
            <h2>Create Task</h2>
            <form action="/create-task" method="POST">
                @csrf
                <input type="text" placeholder="Title" name="title" class="input-field" required>
                <textarea placeholder="Description" name="description" class="input-field" required></textarea>
                <input type="date" name="deadline" class="input-field" required>
                <button class="btn-submit">Create Task</button>
            </form>
        </div>

        <div class="task-list">
            <h2>Task List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Completed</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Deadline</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>
                            <form action="/toggle-completed/{{$task->id}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="checkbox" name="completed" {{ $task->completed ? 'checked' : '' }} onclick="this.form.submit()">
                            </form>
                        </td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->deadline }}</td>
                        <td><a href="/edit-task/{{$task->id}}" class="btn-edit">Edit</a></td>
                        <td>
                            <form action="/delete-task/{{$task->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @else
        <div class="auth-form">
            <h2>Register</h2>
            <form action="/register" method="POST">
                @csrf
                <input type="text" placeholder="Username" name="username" class="input-field" required>
                <input type="text" placeholder="Name" name="name" class="input-field" required>
                <input type="password" placeholder="Password" name="password" class="input-field" required>
                <button class="btn-submit">Register</button>
            </form>
        </div>

        <div class="auth-form">
            <h2>Login</h2>
            <form action="/login" method="POST">
                @csrf
                <input type="text" placeholder="Username" name="lusername" class="input-field" required>
                <input type="password" placeholder="Password" name="lpassword" class="input-field" required>
                <button class="btn-submit">Login</button>
            </form>
        </div>
        @endauth
    </div>

</body>
</html>
