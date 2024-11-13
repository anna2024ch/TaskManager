<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Projekt bearbeiten') }}
        </h2>
    </x-slot>

    @if(session('success'))
    <div class="alert alert-success text-center bg-green-100 text-green-800 p-4 rounded-lg mt-4 max-w-lg mx-auto">
        {{ session('success') }}
    </div>
@endif

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div clas="p-6 bg-white border-b border-gray-200">
                    {{-- Projekterstellungsformular --}}
                    <form method="POST" action="{{ route('projects.update', $project->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Projektname
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-grau-700">
                                Beschreibung
                            </label>
                            <textarea name="description" id="description" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>{{ old('description', $project->description) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-grau-700">
                                Status
                            </label>
                            <select name="status" id="status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required>
                            <option value="aktiv" {{ old('status', $project->status) === 'aktiv' ? 'selected' : '' }}>Aktiv</option>
                            <option value="pausiert" {{ old('status', $project->status) === 'pausiert' ? 'selected' : '' }}>Pausiert</option>
                            </select>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                            Projekt bearbeiten
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
