@extends('layouts.app')

@section('content')
    <div class="flex justify-center font-serif">
        <div class="w-6/12 h-14 bg-gradient-to-r from-cyan-400 to-blue-900 text-white p-6 mt-2  rounded-lg ">
            @auth
            <form action="{{route('posts')}}" method="post" class="mb-4">
                @csrf
                <div class="mb-4">
                <label for="body" class="sr-only">Body</label>
                <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100
                border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post something!"></textarea>
                @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror

                </div>
                <div>
                    <button type="submit" class="h-14 bg-gradient-to-r from-cyan-400 to-blue-900  text-white px-4 py-3 rounded font-medium ">Post</button>
                </div>
            </form>
            @endauth
            @if ($posts->count())
                @foreach ($posts as $post)


            <div class=" mb-4 border-8 border-sky-500 rounded-lg p-4">
                <a href="{{ route('users.posts', $post->user) }}" class="text-bold text-1xl font-bold">{{$post->user->name}}</a> <span
                class="text-gray-900 text-sm">{{ $post->created_at->diffForHumans() }}</span>

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
                <p>There are no posts</p>
            @endif
        </div>
    </div>

@endsection
