@extends('layouts.app')
@section('title') Add New Tag @endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @include('layouts.message')
            <div>
                <h2>Add New Tag</h2>
                <hr>

                <div class="card shadow">
                    <form action="{{ route('store.tag') }}" method="post" class="p-5">
                        @csrf
                        <div class="form-group">
                            <label for="tag">Enter Tag Name</label>
                            <div>
                                <input id="tag" type="text" class="form-control @error('tag') is-invalid @enderror"
                                    name="tag" value="{{ old('tag') }}" autocomplete="tag" autofocus>
                                @error('tag')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ route('create.story') }}" class="btn btn-primary">Back To Story</a>
                        </div>
                    </form>
                </div>

                <h1 class="mt-3">All Tags</h1>
                <table class="table table-striped table-bordered table-hover">
                    <thead class="bg-secondary text-light">
                        <tr>
                            <th>#</th>
                            <th>Tag Name</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$tag->tag}}</td>
                            <td>{{$tag->created_at->format('h:i a, M d, Y')}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $tags->links() }}

            </div>
        </div>
    </div>
</div>
@endsection