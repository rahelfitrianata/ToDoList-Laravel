<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do List Rachel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('logo.ico') }}" type="image/x-icon">
</head>
<body class="flex items-center justify-center h-screen bg-cover bg-center" style="background-image: url('/images/bgcredit.png');">
    
    <div class="form-edit">
        <h2 class="text-2xl font-bold mb-4 text-center text-purple-700">Edit Task</h2>

        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-gray-700">Task Name</label>
                <input type="text" name="title" value="{{ $task->title }}" class="w-full p-2 border rounded bg-purple-100">
            </div>
            <div>
                <label class="block text-gray-700">Status</label>
                <select name="status" class="w-full p-2 border rounded bg-purple-100">
                    <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <div class="flex justify-between">
                <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded">Edit</button>
                <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</a>
            </div>
        </form>
    </div>

</body>
</html>
