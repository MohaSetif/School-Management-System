<x-filament-panels::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}

        <div class="mt-4">
            <x-filament::button type="submit">
                Save Schedule
            </x-filament::button>
        </div>
    </form>

    <hr class="my-6">

    <h2 class="text-xl font-bold mb-4">Existing Weekly Schedule</h2>
    <ul>
        @foreach(\App\Models\Schedule::orderBy('day_of_week')->orderBy('start_time')->get() as $s)
            <li>
                {{ ucfirst($s->day_of_week) }}: {{ $s->start_time }} - {{ $s->end_time }} 
                | {{ $s->subject->name }} 
                | {{ $s->teacher->name }} 
                | Class: {{ $s->class->name }} 
                | Room: {{ $s->room }}
            </li>
        @endforeach
    </ul>
</x-filament-panels::page>
