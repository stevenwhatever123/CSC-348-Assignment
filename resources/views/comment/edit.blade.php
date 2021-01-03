@extends('layouts.app')

@section('title', 'Newsfeed')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit your post</div>

                <div class="card-body">
                    <div class="content">
            
                    <div class="signup">
                        @method('PUT')
                        <form method="POST" action="{{ route('api.comment.save', ['id' => $comment->id]) }}">
                            {{ method_field('PUT') }}
                            @csrf
                            <p> Description: 
                                <input type="text" name = description value="{{ $comment->description }}" required autocomplete="description" autofocus>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </p>

                            <input type="submit" value="Save">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
