@extends('layouts.app')

@section('title', 'Newsfeed')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your Newsfeed</div>

                <div class="card-body">

                    <ul>
                        @foreach ($posts as $post)

                        <li><a href="{{ route('newsfeed.show', ['id' => $post->id]) }}">{{ $post->title }}</a></li>

                        @endforeach
    
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection