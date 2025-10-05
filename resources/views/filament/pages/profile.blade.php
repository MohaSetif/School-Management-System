<x-filament-panels::page class="p-6 bg-neutral-50 dark:bg-neutral-900">
    <div class="max-w-3xl mx-auto bg-white dark:bg-neutral-800 shadow rounded-lg p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-neutral-800 dark:text-neutral-100">Profile</h2>
            <span class="text-sm text-neutral-500 dark:text-neutral-300">Role: {{ ucfirst($userType) }}</span>
        </div>

        <!-- Basic Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-neutral-600 dark:text-neutral-300 font-medium mb-1">Full Name</label>
                <p class="text-neutral-800 dark:text-neutral-100">{{ $user->name }}</p>
            </div>
            <div>
                <label class="block text-neutral-600 dark:text-neutral-300 font-medium mb-1">Email</label>
                <p class="text-neutral-800 dark:text-neutral-100">{{ $user->email }}</p>
            </div>
        </div>

        <!-- Teacher Section -->
        @if($userType === 'teacher')
            <div class="mt-6">
                <h3 class="text-xl font-semibold text-neutral-700 dark:text-neutral-200 mb-3">Teacher Info</h3>

                <!-- Subjects -->
                <form wire:submit.prevent="updateSubjects" class="space-y-4">
                    <label class="block text-neutral-600 dark:text-neutral-300 font-medium mb-1">Subjects</label>
                    <select multiple
                            wire:model="selectedSubjects"
                            class="w-full border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-700 text-neutral-800 dark:text-neutral-100 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:ring-offset-0 focus:border-indigo-500"
                    >
                        @foreach(\App\Models\Subject::all() as $subject)
                            <option value="{{ $subject->id }}">
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700 transition">
                        Save Subjects
                    </button>
                </form>
            </div>
        @elseif($userType === 'student')
            <!-- Student Section -->
            <div class="mt-6">
                <h3 class="text-xl font-semibold text-neutral-700 dark:text-neutral-200 mb-3">Student Info</h3>
                <p class="text-neutral-800 dark:text-neutral-100"><strong>Class:</strong> {{ $profile->group->name ?? 'Not assigned' }}</p>
                <p class="text-neutral-800 dark:text-neutral-100"><strong>Roll Number:</strong> {{ $profile->roll_number ?? '-' }}</p>
            </div>
        @else
            <p class="mt-6 text-neutral-500 dark:text-neutral-400">No extra info available.</p>
        @endif
    </div>
</x-filament-panels::page>
