@extends('layouts.app')
@section('title') Search result of {{ $search }} @endsection
@section('content')
<div class="container">
    <h1>Search Results</h1>
    <hr>
    <div class="row">
        <div class="col-md-8">

            @if (count($result) == 0)
                <h1>Opps, No Match Found!!!</h1>
            @else
                @foreach ($result as $story)
                    @if ($story->is_published)
                        <div class="card mb-3 shadow">
                            <img class="card-img-top" src="{{ asset($story->image) }}" alt="{{ $story->title }}">
                            <div class="card-body">
                                <h2 class="card-title text-justify">{{ $story->title }}</h2>
                                <div class="d-flex justify-content-between">
                                    <p><i class="far fa-user"></i> <a
                                            href="{{ route('profile', $story->user->slug) }}">{{ $story->user->name }}</a></p>
                                    <p><i class="far fa-bookmark"></i> <a
                                            href="{{ route('show.category', strtolower($story->category->name)) }}">{{ ucfirst($story->category->name) }}</a>
                                    </p>
                                    <p><i class="far fa-clock"></i> {{ $story->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p><i class="fas fa-tags"></i>
                                        @foreach ($story->tags as $tag)
                                        <a href="{{ route('show.tag', strtolower($tag->tag)) }}">{{ ucfirst($tag->tag) }}</a>,
                                        @endforeach
                                    </p>
                                    <p><i class="far fa-comment-dots"></i> Comments: {{ $story->comments->count() }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="mt-2">
                                        @if (Auth::id() == $story->user_id)
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
                    @endif
                @endforeach
                {{ $result->links() }}
            @endif

        </div>
        <div class="col-md-4">
            <div class="card mb-3 shadow">
                <img class="card-img-top" src="{{ asset('img/images/image.jpg') }}" alt="sample image">
                <div class="card-body">
                    <h2>A Simple Story Sharing Website</h2>
                    <p class="card-text text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam,
                        beatae fugiat
                        maxime sed,
                        aliquid doloremque omnis nesciunt earum iure, aut sequi dolores praesentium optio quis libero
                        tempora esse
                        debitis laborum?</p>
                </div>
            </div>
            <div class="card mb-3 shadow">
                <div class="card-header">
                    <h2>Top 5 Categories</h2>
                </div>
                <div class="card-body">
                    @foreach ($categories as $category)
                    <p><i class="fas fa-circle"></i> <a
                            href="{{ route('show.category', strtolower($category->name)) }}">{{ ucfirst($category->name) }}</a> ({{ $category->stories->count() }} stories)
                    </p>
                    @endforeach
                </div>
            </div>
            <div class="card mb-3 shadow">
                <div class="card-header">
                    <h2>Top 5 Tags</h2>
                </div>
                <div class="card-body">
                    @foreach ($tagssss as $tag)
                    <p><i class="fas fa-tags"></i> <a
                            href="{{ route('show.tag', strtolower($tag->tag)) }}">{{ ucfirst($tag->tag) }}</a> ({{ $tag->stories->count() }} stories)</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection