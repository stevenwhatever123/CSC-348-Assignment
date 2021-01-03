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
                        <form method="POST" action="{{ route('newsfeed.save', ['id' => $post->id]) }}" enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            @csrf
                            <p> Title: 
                                <input type="text" name = title value="{{ $post->title }}" required autocomplete="name" autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </p>


                            <p> Description: 
                                <input type="text" name = description value="{{ $post->description }}" required autocomplete="description" autofocus>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </p>


                            <p> Is it safe from work (SFW)?: 
                               <select name="SFW" id="SFW"> 
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </p>
                            
                            <p> Select Image to Upload: 
                                <input type="file" name= image value=" {{ $post->image }}">
                                @error('image')
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
