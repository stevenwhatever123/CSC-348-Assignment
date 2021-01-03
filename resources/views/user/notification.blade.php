@extends('layouts.app')

@section('title', 'Animal Details')

@section('head')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@endsection('head')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your Newsfeed</div>

                <div class="card-body">

                <p>Friend Request:</p>

                    <ul>
    
                        @foreach ($friend_request as $request)
        
                        <li><a href="{{ route('user.show', ['id' => $request->get_website_user->id]) }}">
                            {{ $request->get_website_user->name}}</a> 
                            wants to be your friend: 

                            <div id="add-friend-component">

                                <button onclick="actOnAccept(event);" type="subimt" 
                                    style="color:rgb(0,0,255);" data-chirp-id="{{ $request->id }}">Accept</button>

                                <button onclick="actOnAccept(event);" type="subimt" style="color:rgb(255,0,0)"
                                    data-chirp-id="{{ $request->id }}">Reject</button>
                            </div>
                         </li>

                        @endforeach
    
                    </ul>

                    <br>

                    <p>Notification on Post:</p>

                    <ul>
                        
                        @foreach ($likes as $like)

                            <div id="notification-like-component">
                            
                                <li><a href="{{ route('user.show', ['id' => $like->get_website_user->id]) }}">{{ $like->get_website_user->name }}</a> 
                                    likes your post: 
                                    <a href="{{ route('newsfeed.show', ['id' => $like->get_post->id]) }}" 
                                        data-chirp-id="{{ $like->id }}" onclick="actOnLikePost(event);">{{ $like->get_post->title }}</a>
                                </li>
                            
                            </div>

                        @endforeach

                        @foreach ($comments as $comment)
                            <div id="notification-like-component">
                            
                                 <li><a href="{{ route('user.show', ['id' => $comment->get_website_user->id]) }}">{{ $comment->get_website_user->name }}</a> 
                                    leaves a comment on your post: 
                                    <a href="{{ route('newsfeed.show', ['id' => $comment->get_post->id]) }}" 
                                        data-chirp-id="{{ $comment->id }}" onclick="actOnCommentPost(event);">{{ $comment->get_post->title }}</a>
                                </li>
                        
                             </div>
                        @endforeach
                        
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>

    var app = new Vue({
        el: "#add-friend-component",
        data: {

        },
    })

    var toggleButton = {
        Accept: function(button) {
            button.textContent = "Accepted";
            var id = event.target.dataset.chirpId;
            console.log("Id: " + id);
            axios.put("/user/" + id + "/accept");
            window.location.reload();
        },

        Reject: function(button) {
            button.textContent = "Rejected";
            var id = event.target.dataset.chirpId;
            console.log("Id: " + id);
            axios.delete("/user/" + id + "/reject");
            window.location.reload();
        }
    };

    var actOnAccept = function (event) {
            var user_id_to_add = event.target.dataset.chirpId;
            var action = event.target.textContent;
            toggleButton[action](event.target);
        };

    //

    var app2 = new Vue({
        el: "#notification-like-component",
        data: {

        },
    })

    var actOnLikePost = function (event) {
        var id = event.target.dataset.chirpId;
        var action = event.target.textContent;
        console.log("Id: " + id);
        axios.put("/like/" + id + "/read");
    };

    var actOnCommentPost = function (event) {
        var id = event.target.dataset.chirpId;
        var action = event.target.textContent;
        console.log("Id: " + id);
        axios.put("/comment/" + id + "/read");
    }


</script>
@endsection