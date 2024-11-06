<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Neue Aufgabe') }}
        </h2>
    </x-slot>


<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 bg=white border-b border-grau-200">
                <form>
                    <h1> @csrf </h1>

                    <div class="mb-4">
                        <label for="derscription" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title"
                            class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-600 focus:ring-indigo-500"
                            required>
                     </div>

                     <div class="mb-4">
                        <label for="derscription" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea type="text" name="derscription" id="derscription" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-600 focus:ring-indigo-500"
                            required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="project_id" class="block text-sm font-medium text-gray-700"><del>
                            </del>Projects</label>
                        <select type="text" name="project_id" id="project_id" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-600 focus:ring-indigo-500"
                            required>
                        @foreach ($projects as $project )
                            <option value="{{ $project->id }}">{{ $project->name }} </option>

                        @endforeach

                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select type="text" name="status" id="status" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-600 focus:ring-indigo-500"
                            required>
                            <option value="neu">Neu</option>
                            <option value="in_bearbeitung">In Bearbeitung</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                    <select name="priority" id="priority"
                        class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-600 focus:ring-indigo-500"
                        required>
                        <option value="niedrig">Niedrig</option>
                        <option value="mittiel">Mittiel</option>
                        <option value="hoch">Hoch</option>

                    </select>
                    </div>

                    <div class="mb-4">
                        <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date: </label>
                        <input type="date" name="due_date" id="due_date"
                            class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-600 focus:ring-indigo-500"
                            required>

                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-800 transition-colors">
                            Submit New Task
                        </button>
                    </div>



                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
