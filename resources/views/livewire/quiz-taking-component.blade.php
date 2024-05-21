<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-4">{{ $quiz->title }}</h1>
    <form wire:submit.prevent="submitQuiz">
        @foreach($questions as $question)
        <div class="mb-4">
            <p class="font-bold">{{ $question->text }}</p>
            @foreach($question->options as $key => $option)
            <label class="block">
                <input type="radio" wire:model="answers.{{ $question->id }}" value="{{ $key }}"> {{ $option }}
            </label>
            @endforeach
        </div>
        @endforeach
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit Quiz</button>
    </form>
</div>
