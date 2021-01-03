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

                    <p>User: {{ $user->name }}</p>
                    <p>Email: {{ $user->email }}</p>

                    <div id="add-friend-component">

                        <button onclick="actOnButton(event);" type="subimt" class="btn btn-primary" id="button" data-chirp-id="{{ $user->id }}"
                            style="background-color:rgb(0,0,255); border-color:rgb(0,0,255);">@{{ Text }}</button>

                    </div>

                    <br>

                    <br>

                    <p>Post from {{ $user->name }}:</p>


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

@section('script')
<script>

    var app = new Vue({
        el: "#add-friend-component",
        data: {
            Text: "Add Friend",
        },
    })

    var toggleButtonText = {
        AddFriend: function(button) {
            button.textContent = "Requested";
            document.getElementById("button").style.background = "#818181";
            document.getElementById("button").style.borderColor = "#818181";
        },

        Requested: function(button) {
            button.textContent = "Add Friend";
            document.getElementById("button").style.background = "rgb(0,0,255)";
            document.getElementById("button").style.borderColor = "rgb(0,0,255)s";
        }
    };

    var actOnButton = function (event) {
            var user_id_to_add = event.target.dataset.chirpId;
            var action = event.target.textContent;
            var action = action.split(" ").join("");
            toggleButtonText[action](event.target);
            axios.post("/user/" + user_id_to_add + "/addFriend");
        };

</script>
@endsection