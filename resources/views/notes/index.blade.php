<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ request()->routeIs('notes.index') ? __('Notes') : __('Trashed')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-alert-success>  {{session('success')}}</x-alert-success>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(request()->routeIs('notes.index'))
                <a href="{{ route('notes.create') }}" class="btn-link btn-lg mb-2">+ New Note</a>
            @endif
            @forelse($notes as $note)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        @if(request()->routeIs('notes.index'))
                            <a href="{{route('notes.show', $note)}}">
                                {{$note->title}}
                            </a>
                        @else
                            <a href="{{route('trashed.show', $note)}}">
                                {{$note->title}}
                            </a>
                        @endif
                    </h2>
                    <p class="mt-2">
                        {{Str::limit($note->text, 20) }}
                    </p>
                    <span class="block mt-4"> {{$note->updated_at->diffForHumans()}}</span>
                </div>
            @empty
                @if(request()->routeIs('notes.index'))
                    <p> You have no notes yet.</p>
                @else
                    <p> You have no Trashed notes yet.</p>
                @endif
            @endforelse
            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>
