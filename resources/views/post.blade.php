@extends('layouts.app')

@section('title', 'Newsfeed')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new Post</div>

                <div class="card-body">
                    <div class="content">
            
                    <div class="signup">
                        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                            @csrf
                            <p> Title: 
                                <input type="text" name = title value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </p>


                            <p> Description: 
                                <input type="text" name = description value="{{ old('description') }}" required autocomplete="description" autofocus>
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
                                <input type="file" name= image>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </p>

                            <input type="submit" value="Post">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
