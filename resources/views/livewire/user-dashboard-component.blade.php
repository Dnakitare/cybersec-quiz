<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>

    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4">Your Quiz Results</h2>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Quiz</th>
                    <th class="px-4 py-2">Score</th>
                    <th class="px-4 py-2">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                <tr>
                    <td class="border px-4 py-2">{{ $result->quiz->title }}</td>
                    <td class="border px-4 py-2">{{ $result->score }}</td>
                    <td class="border px-4 py-2">{{ $result->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Take a Quiz</h2>
        @foreach($categories as $category)
        <div class="mb-4">
            <h3 class="text-lg font-semibold">{{ $category->name }}</h3>
            <ul class="list-disc list-inside">
                @foreach($category->quizzes as $quiz)
                <li>
                    <a href="{{ route('quizzes.take', $quiz->id) }}" class="text-blue-500 hover:underline">{{ $quiz->title }}</a>
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>
</div>
