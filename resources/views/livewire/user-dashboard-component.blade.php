<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Flash Messages -->
        @if (session()->has('message'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                {{ session('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Welcome Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Welcome back, {{ auth()->user()->name }}!</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">Continue your cybersecurity training journey.</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Available Quizzes -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Available Quizzes</h2>
                    </div>
                    <div class="p-6">
                        @forelse($categories as $category)
                            @if($category->quizzes->count() > 0)
                                <div class="mb-6 last:mb-0">
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-3">
                                        {{ $category->name }}
                                    </h3>
                                    <div class="space-y-3">
                                        @foreach($category->quizzes as $quiz)
                                            @php
                                                $hasTaken = $results->contains('quiz_id', $quiz->id);
                                                $result = $results->firstWhere('quiz_id', $quiz->id);
                                            @endphp
                                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                                <div class="flex items-center space-x-3">
                                                    <div class="flex-shrink-0">
                                                        @if($hasTaken)
                                                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                                </svg>
                                                            </div>
                                                        @else
                                                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-gray-900 dark:text-white">{{ $quiz->title }}</p>
                                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                                            {{ $quiz->questions_count ?? $quiz->questions->count() }} questions
                                                        </p>
                                                    </div>
                                                </div>
                                                <div>
                                                    @if($hasTaken)
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                            Completed
                                                        </span>
                                                    @else
                                                        <a href="{{ route('quizzes.take', $quiz) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">
                                                            Start Quiz
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No quizzes available</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Check back later for new quizzes.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Results Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Your Results</h2>
                    </div>
                    <div class="p-6">
                        @forelse($results as $result)
                            <div class="mb-4 last:mb-0 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="flex justify-between items-start mb-2">
                                    <p class="font-medium text-gray-900 dark:text-white text-sm">{{ $result->quiz->title }}</p>
                                    @php
                                        $total = $result->quiz->questions_count ?? 0;
                                        $percentage = $total > 0 ? round(($result->score / $total) * 100) : 0;
                                    @endphp
                                    <span class="text-lg font-bold {{ $percentage >= 70 ? 'text-green-600 dark:text-green-400' : ($percentage >= 50 ? 'text-yellow-600 dark:text-yellow-400' : 'text-red-600 dark:text-red-400') }}">
                                        {{ $percentage }}%
                                    </span>
                                </div>
                                <div class="flex justify-between items-center text-xs text-gray-500 dark:text-gray-400">
                                    <span>{{ $result->score }}/{{ $total }} correct</span>
                                    <span>{{ $result->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="mt-2 w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                    <div class="h-2 rounded-full {{ $percentage >= 70 ? 'bg-green-500' : ($percentage >= 50 ? 'bg-yellow-500' : 'bg-red-500') }}" style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No quiz results yet.</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">Take a quiz to see your score here!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
