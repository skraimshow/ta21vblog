@extends('partials.layout')

@section('content')
<div class="container mx-auto">
    <div class="min-h-full shadow-xl card bg-base-200">
        <div class="card-body">
            <h2 class="card-title">{{ $user->name }}</h2>
            <h2 class="text-gray-500">Followers: {{ $user->followers->count() }}</h2>
            <h2 class="text-gray-500">Followees: {{ $user->followees->count() }}</h2>
            <a href="{{route('follow', ['user'=> $user])}}"
                class="btn {{$user->authHasFollowed ? 'btn-error' : 'btn-success'}}">
                @if($user->authHasFollowed)
                Unfollow
                @else
                Follow
                @endif
            </a>
        </div>
    </div>
    <div class="flex flex-row flex-wrap mt-8">
        @foreach ($posts as $post)
        <div class="mb-2 basis-1/4">

            <div class="min-h-full mx-2 shadow-xl card bg-base-200">
                @if ($post->images()->count() === 1)
                <figure>
                    <img src="{{ $post->images()->first()->path }}" alt="{{ $post->title }}" />
                </figure>
                @elseif($post->images()->count() > 1)
                <div class="carousel rounded-box">
                    @foreach ($post->images as $image)
                    <div class="w-full carousel-item">
                        <img src="{{$image->path}}" class="w-full" alt="{{ $post->title }}" />
                    </div>
                    @endforeach
                </div>
                @endif
                <div class="card-body">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <p>{{ $post->snippet }}...</p>
                    <p class="text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                    <p class="text-gray-500">
                        <a href="{{route('user', ['user'=> $post->user])}}">{{ $post->user->name }}</a>
                    </p>
                    <p class="text-gray-500">Likes: {{ $post->likes()->count() }}</p>
                    <div class="justify-end card-actions">
                        <a href="{{route('like', ['post'=> $post])}}"
                            class="btn {{$post->authHasLiked ? 'btn-error' : 'btn-success'}}">
                            @if($post->authHasLiked)
                            Unlike
                            @else
                            Like
                            @endif
                        </a>
                        <a href="{{route('post', ['post'=> $post])}}" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>

        </div>
        @endforeach
    </div>
</div>
@endsection