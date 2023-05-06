<x-layout>
    <x-slot name="title">
        Laravel8 Docker Posts
    </x-slot>
    <h1>Posts</h1>
    <ul>
        @foreach ($posts as $post)
            <li>
                <a href="{{ url('posts', $post) }}">{{ $post->title }}</a>
            </li>
        @endforeach
    </ul>
    <a href="{{ url('post/create') }}">Create</a>
</x-layout>
