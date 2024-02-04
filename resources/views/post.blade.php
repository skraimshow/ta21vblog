@extends('partials.layout')

@section('content')
    <div class="container mx-auto">
        <div class="card bg-base-200 shadow-xl min-h-full">
            @if ($post->images()->count() === 1)
                <figure>
                    <img src="{{ $post->images()->first()->path }}" alt="{{ $post->title }}" />
                </figure>
            @elseif($post->images()->count() > 1)
                <div class="carousel rounded-box">
                    @foreach ($post->images as $image)
                        <div class="carousel-item w-full">
                            <img src="{{ $image->path }}" class="w-full" alt="{{ $post->title }}" />
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="card-body">
                <h2 class="card-title">{{ $post->title }}</h2>
                <p>{{ $post->body }}</p>
                <p class="text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="text-gray-500">{{ $post->user->name }}</p>
            </div>
        </div>

        <div class="card bg-base-200 shadow-xl min-h-full my-2">
            <div class="card-body">
               <form action="{{route('comment', ['post' => $post])}}" method="POST">
                    @csrf
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Comment</span>
                        </label>
                        <textarea class="textarea textarea-bordered h-24 w-full" placeholder="Content" name="body">{{ old('body') }}</textarea>
                        @error('body')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-primary mt-2" value="Comment">
               </form>
            </div>
        </div>

        @foreach ($post->comments()->latest()->get() as $comment)
            <div class="card bg-base-200 shadow-xl min-h-full my-2">
                <div class="card-body">
                    <p>{{ $comment->body }}</p>
                    <p class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                    <p class="text-gray-500">{{ $comment->user->name }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
