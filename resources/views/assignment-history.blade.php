<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment History</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('logo.ico') }}" type="image/x-icon">
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <div class="flex items-center mb-4">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold">&larr;</a>
            <h1 class="text-2xl font-bold text-center flex-1">Assignment History</h1>
        </div>

        <div class="mb-6">
            <h2 class="text-gray-500 text-sm font-semibold">{{ \Carbon\Carbon::today()->format('d/m/Y') }}</h2>
            @if ($tasks->isNotEmpty())
                <ul>
                    @foreach ($tasks as $task)
                        <li class="flex justify-between items-center bg-gray-200 p-3 mt-2 rounded">
                            <div class="flex items-center space-x-2">
                                <span class="{{ $task->status == 'Completed' ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $task->status == 'Completed' ? '✔' : '⚠' }}
                                </span>
                                <span>{{ $task->title }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-600 text-center mt-2">No tasks available today.</p>
            @endif
        </div>

        @foreach ($assignmentHistories as $date => $assignments)
            <div class="mb-4">
                <h2 class="text-gray-500 text-sm font-semibold">{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</h2>
                <ul>
                    @foreach ($assignments as $assignment)
                        <li class="flex justify-between items-center bg-gray-200 p-3 mt-2 rounded">
                            <div class="flex items-center space-x-2">
                                <span class="{{ $assignment->status == 'Completed' ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $assignment->status == 'Completed' ? '✔' : '⚠' }}
                                </span>
                                <span>{{ $assignment->title }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach

    </div>

</body>
</html>
