@extends('layouts.app')

@section('content')
    <div class="flex justify-center font-serif">
        <div class="w-6/12 ">
            <div class="p-6 text-white text-bold font-serif">
                <h1 class="text-3xl  font-medium mb-1">{{ $user->name }}</h1>
                <p>Posted: {{$posts->count()}} {{Str::plural('post', $posts->count())}} and recieved {{$user->recievedLikes->count()}} likes</p>
            </div>

            <div class=" bg-white p-6 mt-2  rounded-lg">
                @if ($posts->count())
                    @foreach ($posts as $post)


            <div class="mb-4 font-serif  border-8 border-sky-500 rounded-lg p-4">
                <a href="{{ route('users.posts', $post->user) }}" class="text-bold text-1xl font-bold">{{$post->user->name}}</a> <span
                class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>

                <p class="mb-2">{{$post->body}}</p>

                @can('delete', $post)
                <form action="{{ route('posts.destroy', $post)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-blue-900">Delete</button>
                </form>
                @endcan

                <div class="flex items-center">
                    @auth
                    @if(!$post->likedBy(auth()->user()))
                        <form action="{{route('posts.likes', $post)}}" method="post" class="mr-1">
                            @csrf
                            <button type="submit" class="text-blue-900">Like</button>
                        </form>
                    @else
                        <form action="{{route('posts.likes', $post)}}" method="post" class="mr-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-blue-900">Unlike</button>
                        </form>
                    @endif
                    @endauth
                    <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count())}}</span>
                </div>
            </div>

                    @endforeach

                    {{ $posts->links() }}
                @else
                    <p>{{ $user->name}} does not have any post</p>
                @endif
            </div>
        </div>
    </div>

@endsection
