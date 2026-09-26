<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6f8;
            padding: 30px;
            color: #333;
        }

        .container {
            max-width: 700px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        h1 {
            color: #2f4858;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #777;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 14px;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .error {
            color: #d9534f;
            font-size: 13px;
            margin-top: 5px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        button,
        .back-btn {
            padding: 11px 18px;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .save-btn {
            background: #2f4858;
            color: white;
        }

        .back-btn {
            background: #ddd;
            color: #333;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Add New Task</h1>
        <p class="subtitle">Create a new task for your task manager.</p>

        @if($errors->any())
            <div class="error">
                Please fix the errors below.
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">

            @csrf

            <div class="form-group">
                <label for="task_name">Task Name</label>

                <input
                    type="text"
                    id="task_name"
                    name="task_name"
                    value="{{ old('task_name') }}"
                    placeholder="Enter task name"
                    required
                >

                @error('task_name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>

                <textarea
                    id="description"
                    name="description"
                    placeholder="Enter task description"
                >{{ old('description') }}</textarea>

                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>

                <select id="status" name="status" required>
                    <option value="Pending"
                        {{ old('status', 'Pending') === 'Pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="Completed"
                        {{ old('status') === 'Completed' ? 'selected' : '' }}>
                        Completed
                    </option>
                </select>

                @error('status')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="due_date">Due Date</label>

                <input
                    type="date"
                    id="due_date"
                    name="due_date"
                    value="{{ old('due_date') }}"
                >

                @error('due_date')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="buttons">

                <button type="submit" class="save-btn">
                    Save Task
                </button>

                <a href="{{ route('tasks.index') }}" class="back-btn">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>