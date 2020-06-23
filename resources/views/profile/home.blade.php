@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="d-flex justify-content-between">
        <h1>
            @if (Auth::id() == $user->id)
            Your Profile Information {{ strtoupper($user->name) }}
            @else
            Welcome to {{ $user->name }}'s Profile
            @endif
        </h1>
        @if (Auth::id() == $user->id)
        <a href="{{ route('create.story') }}" class="btn btn-primary btn-lg">Add New Story</a>
        @endif
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="p-3">
                    <p class="text-center">
                        <img src="{{ asset($user->avatar) }}" height="280" class="rounded-circle" alt="profile picture">
                    </p>
                    <p class="text-center">
                        @if ($user->is_admin === 1)
                        <i class="fas fa-circle text-success"></i> <strong>Admin</strong>
                        @elseif ($user->is_admin === 0)
                        <i class="fas fa-circle text-warning"></i> <strong>User</strong>
                        @endif
                    </p>
                    <h2>Name: {{ $user->name }}</h2>
                    <div>
                        <p>Email: {{ $user->email }}</p>
                        <p>Phone: {{ $user->phone }}</p>
                        <p>Gender: {{ $user->gender }}</p>
                        <p>Birthday: {{ $user->dob }}</p>
                    </div>
                    @if (Auth::id()== $user->id)
                    <a href="{{ route('edit.profile.info', Auth::user()->slug) }}"
                        class="btn btn-primary btn-sm btn-block">Edit
                        Profile Info</a>
                    <a href="{{ route('edit.profile.picture', Auth::user()->slug) }}"
                        class="btn btn-secondary btn-sm btn-block">Edit Profile Picture</a>
                    <a href="{{ route('edit.profile.password', Auth::user()->slug) }}"
                        class="btn btn-success btn-sm btn-block">Update Password</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h3 class="text-center">
                @if (Auth::id() == $user->id)
                Your Latest Stories
                @else
                {{ $user->name }}'s Latest Stories
                @endif
            </h3>
            @foreach ($user->stories as $story)
            <div class="card mb-3 shadow">
                <img class="card-img-top img-fluid" src="{{ asset($story->image) }}" alt="{{ $story->title }}">
                <div class="card-body">
                    <h2 class="card-title">{{ $story->title }}</h2>
                    <p class="card-text text-justify">{{ substr($story->story, 0, 150) . '.........' }}</p>
                    <div class="d-flex justify-content-between">
                        <p><i class="far fa-bookmark"></i> <a
                                href="{{ route('show.category', strtolower($story->category->name)) }}">{{ ucfirst($story->category->name) }}</a>
                        </p>

                        <p><i class="far fa-clock"></i> {{ $story->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p><i class="fas fa-tags"></i>
                            @foreach ($story->tags as $tag)
                            <a href="{{ route('show.tag', strtolower($tag->tag)) }}">{{ ucfirst($tag->tag) }},</a>
                            @endforeach
                        </p>
                        <p><i class="far fa-comment-dots"></i> Comments: 0</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="mt-2">
                            @if (Auth::id() == $user->id)
                            <a href="{{ route('edit.story', $story->slug) }}"><i
                                    class="far fa-edit text-success fa-2x mr-2"></i></a>
                            <a href="{{ route('delete.story', $story->slug) }}"><i
                                    class="fas fa-trash-alt text-danger fa-2x"></i></a>
                            @endif
                        </div>
                        <a href="{{ route('single.story', $story->slug) }}" class="btn btn-primary float-right">Read
                            More >>></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection