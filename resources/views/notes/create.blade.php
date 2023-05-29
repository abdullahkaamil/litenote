<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{route('notes.store')}}" method="post">
                        @csrf
                        <x-text-input type="text" name="title" placeholder="title" class="w-full"></x-text-input>
                        @error('title')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror
                        <x-text-area type="text" rows="10" name="text" placeholder="type here ......."
                                     class="w-full mt-6"></x-text-area>
                        @error('text')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror
                        <x-primary-button class="mt-6"> {{ __('Save') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
