<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do List Rachel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('logo.ico') }}" type="image/x-icon">
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">To Do List</h1>
            <a href="{{ route('assignment.history') }}" class="px-4 py-2 bg-purple-500 text-white rounded">
                Assignment History
            </a>
        </div>

        <form action="{{ route('tasks.store') }}" method="POST" class="mb-4 flex">
            @csrf
            <input type="hidden" name="status" value="Pending">
            <a href="{{ route('tasks.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-r text-lg font-bold">
                +
            </a>
        </form>
@if ($tasks->isNotEmpty())
        @foreach ($tasks as $date => $taskGroup)
            <h2 class="text-gray-500 font-semibold mt-4">{{ $date }}</h2> <!-- Menampilkan tanggal -->
            <ul>
                @foreach ($taskGroup as $task)
                    <li class="flex justify-between items-center bg-gray-200 p-3 mb-2 rounded">
                        <span class="flex items-center">
                            <span class="mr-2 {{ $task->status == 'Completed' ? 'text-green-500' : 'text-red-500' }}">
                                {{ $task->status == 'Completed' ? '✔' : '⚠' }}
                            </span>
                            {{ $task->title }}
                        </span>
                        <div class="flex space-x-2">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="text-green-600">✏️</a>
                            <a href="{{ route('tasks.delete', $task->id) }}" class="text-red-600">🗑️</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endforeach
    @else
        <p class="text-gray-600 text-center mt-4">No tasks available.</p>
    @endif

    <form action="{{ route('logout') }}" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="w-full bg-red-500 text-white p-2 rounded">Logout</button>
    </form>
</div>

    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Mencegah form langsung submit

            if (confirm("Are you sure to delete this task?")) {
                event.target.submit(); // Submit form jika user menekan "OK"
            }
        }
    </script>

</body>
</html>
