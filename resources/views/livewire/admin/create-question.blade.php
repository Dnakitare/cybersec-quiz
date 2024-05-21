<div class="fixed z-10 inset-0 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <div class="fixed inset-0 transition-opacity" aria-hidden="true">
          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
      <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <div class="sm:flex sm:items-start">
                  <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                      <h3 class="text-lg leading-6 font-medium text-gray-900">
                          {{ $question_id ? 'Edit Question' : 'Create Question' }}
                      </h3>
                      <div class="mt-2">
                          <form>
                              <div class="mb-4">
                                  <label for="quiz_id" class="block text-gray-700 text-sm font-bold mb-2">Quiz:</label>
                                  <select id="quiz_id" wire:model="quiz_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                      <option value="">Select Quiz</option>
                                      @foreach($quizzes as $quiz)
                                      <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                                      @endforeach
                                  </select>
                                  @error('quiz_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                              </div>
                              <div class="mb-4">
                                  <label for="text" class="block text-gray-700 text-sm font-bold mb-2">Text:</label>
                                  <input type="text" id="text" wire:model="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                  @error('text') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                              </div>
                              <div class="mb-4">
                                  <label for="options" class="block text-gray-700 text-sm font-bold mb-2">Options (comma separated):</label>
                                  <input type="text" id="options" wire:model="options" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                  @error('options') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                              </div>
                              <div class="mb-4">
                                  <label for="correct_answer" class="block text-gray-700 text-sm font-bold mb-2">Correct Answer:</label>
                                  <input type="text" id="correct_answer" wire:model="correct_answer" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                  @error('correct_answer') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                              </div>
                              <div class="mt-5 sm:mt-6">
                                  <button wire:click.prevent="store" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                                  <button wire:click="closeModal" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>