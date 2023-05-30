<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ !$note->trashed()? __('Notes') : __('Trashed') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>  {{session('success')}}</x-alert-success>
            @if(!$note->trashed())
            <div class="flex">
                <p class="opacity-70">
                    <strong>Created:</strong> {{$note->created_at->diffForHumans()}}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Updated:</strong> {{$note->updated_at->diffForHumans()}}
                </p>
                <a class="btn-link btn ml-auto " href="{{route('notes.edit',$note)}}"> Edit Note </a>
                <form action="{{route('notes.destroy', $note)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger ml-4"
                            onclick="return confirm('are you sure ?')"> {{ __('Move to Trash') }}</button>
                </form>
            </div>
            @else
                <div class="flex">
                    <p class="opacity-70 ml-8">
                        <strong>Deleted:</strong> {{$note->deleted_at->diffForHumans()}}
                    </p>
                    <form action="{{route('trashed.update', $note)}}" method="post">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-danger ml-4"
                                onclick="return confirm('are you sure ?')"> {{ __('Restore') }}</button>
                    </form>
                    <form action="{{route('trashed.destroy', $note)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger ml-4"
                                onclick="return confirm('are you sure ?')"> {{ __('Delete Permanently ') }}</button>
                    </form>
                </div>
            @endif
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h5 class="font-bold text-4xl">
                    {{$note->title}}
                </h5>
                <p class="mt-2 whitespace-pre-wrap">{{$note->text}}</p>
            </div>
        </div>
    </div>
</x-app-layout>
