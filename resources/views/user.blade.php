@extends('partials.layout')

@section('content')
    <div class="container mx-auto">
        <div class="card bg-base-200 shadow-xl min-h-full">
            <div class="card-body">
                <h2 class="card-title">{{ $user->name }}</h2>
                <h2 class="text-gray-500">Followers: {{ $user->followers->count() }}</h2>
                <h2 class="text-gray-500">Followees: {{ $user->followees->count() }}</h2>
                <a href="{{route('follow', ['user'=> $user])}}" class="btn {{$user->authHasFollowed ? 'btn-error' : 'btn-success'}}">
                    @if($user->authHasFollowed)
                        Unfollow
                    @else
                        Follow
                    @endif
                </a>
            </div>
        </div>
    </div>
@endsection
