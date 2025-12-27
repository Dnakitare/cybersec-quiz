<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <!-- Quiz Header -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <a href="{{ route('dashboard') }}" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 flex items-center mb-2">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Back to Dashboard
                        </a>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $quiz->title }}</h1>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Questions</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ count($viewQuestions) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quiz Form -->
        <form wire:submit.prevent="submitQuiz">
            <div class="space-y-6">
                @foreach($viewQuestions as $index => $question)
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                        <div class="px-6 py-4">
                            <div class="flex items-start space-x-4">
                                <span class="flex-shrink-0 w-8 h-8 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 rounded-full flex items-center justify-center font-semibold text-sm">
                                    {{ $index + 1 }}
                                </span>
                                <div class="flex-1">
                                    <p class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ $question['text'] }}</p>
                                    <div class="space-y-3">
                                        @foreach($question['options'] as $key => $option)
                                            <label class="flex items-center p-4 border-2 rounded-lg cursor-pointer transition-all
                                                {{ isset($answers[$question['id']]) && $answers[$question['id']] === $key
                                                    ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/30'
                                                    : 'border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-500' }}">
                                                <input
                                                    type="radio"
                                                    wire:model="answers.{{ $question['id'] }}"
                                                    value="{{ $key }}"
                                                    class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                                >
                                                <span class="ml-3 flex items-center">
                                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium mr-3">
                                                        {{ $key }}
                                                    </span>
                                                    <span class="text-gray-700 dark:text-gray-300">{{ $option }}</span>
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Submit Section -->
            <div class="mt-8 bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                @php
                                    $answeredCount = collect($answers)->filter()->count();
                                @endphp
                                {{ $answeredCount }} of {{ count($viewQuestions) }} questions answered
                            </p>
                            <div class="mt-2 w-48 bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                <div class="h-2 rounded-full bg-blue-500 transition-all" style="width: {{ count($viewQuestions) > 0 ? ($answeredCount / count($viewQuestions)) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <button
                            type="submit"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition shadow-lg shadow-blue-500/25 disabled:opacity-50 disabled:cursor-not-allowed"
                            {{ $answeredCount < count($viewQuestions) ? 'disabled' : '' }}
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Submit Quiz
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
