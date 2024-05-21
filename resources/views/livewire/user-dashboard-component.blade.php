<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>
    <div class="bg-white shadow rounded-lg p-6">
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
</div>
