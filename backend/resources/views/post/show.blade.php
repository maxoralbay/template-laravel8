<x-layout>
    <x-slot name="title">
        Laravel8 Docker Posts
    </x-slot>
    <h1>{{ $post->title }}</h1>
    <img src="{{$post->image}}" />
    <p>{{ $post->content }}</p>
    <a href="{{ url('post/edit', $post) }}">Edit</a>
    <form action="{{ url('post/delete', $post) }}" method="post">
        @csrf
        <button>Delete</button>
    </form>
    <a href="{{ url('posts') }}">Back</a>
</x-layout>
