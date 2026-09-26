<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Task Manager</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6f8;
            color: #333;
            padding: 30px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .header {
            background: #2f4858;
            color: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .header h1 {
            margin-bottom: 8px;
        }

        .header p {
            color: #dce5ea;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border: none;
            border-radius: 7px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-add {
            background: #2f4858;
            color: white;
        }

        .btn-edit {
            background: #e8a317;
            color: white;
        }

        .btn-delete {
            background: #d9534f;
            color: white;
        }

        .btn-status {
            background: #4f772d;
            color: white;
        }

        .success {
            background: #dff0d8;
            color: #3c763d;
            padding: 12px 15px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .table-container {
            background: white;
            border-radius: 12px;
            padding: 20px;
            overflow-x: auto;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f8f9fa;
            color: #555;
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .pending {
            background: #fff3cd;
            color: #856404;
        }

        .completed {
            background: #d4edda;
            color: #155724;
        }

        .actions {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #888;
        }

        form {
            display: inline;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Personal Task Manager</h1>
        <p>Organize your tasks and keep track of your progress.</p>
    </div>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="top-bar">
        <h2>My Tasks</h2>

        <a href="{{ route('tasks.create') }}" class="btn btn-add">
            + Add Task
        </a>
    </div>

    <div class="table-container">

        @if($tasks->count() > 0)

            <table>
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($tasks as $task)

                        <tr>
                            <td>
                                <strong>{{ $task->task_name }}</strong>
                            </td>

                            <td>
                                {{ $task->description ?? 'No description' }}
                            </td>

                            <td>
                                <span class="status {{ $task->status === 'Completed' ? 'completed' : 'pending' }}">
                                    {{ $task->status }}
                                </span>
                            </td>

                            <td>
                                {{ $task->due_date ?? 'No date' }}
                            </td>

                            <td>
                                <div class="actions">

                                    <a href="{{ route('tasks.edit', $task) }}"
                                       class="btn btn-edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('tasks.status', $task) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn btn-status">
                                            {{ $task->status === 'Pending' ? 'Complete' : 'Pending' }}
                                        </button>
                                    </form>

                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this task?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-delete">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>

        @else

            <div class="empty">
                <h3>No tasks yet</h3>
                <p>Click "Add Task" to create your first task.</p>
            </div>

        @endif

    </div>

</div>

</body>
</html>