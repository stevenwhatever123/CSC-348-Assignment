@extends('layouts.app')

@section('title', 'Post Details')

@section('head')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@endsection('head')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $post->title}}</div>

                <div class="card-body">

                    <div class="content">

                        <p>Author: <a href= "{{ route('user.show', ['id' => $post->website_user_id]) }}" >{{ $post->get_website_user->name }}</a></p>

                        <p>{{ $post->description }}</p>
                        
                        @if ($post->image != "null")
                            <br>

                            <img src="{{ $post->image }}">

                            <br>
                        @endif

                        <br>
                        <br>

                        <!--
                        <button onclick="like(event);" data-chirp-id="{{ $post->id }}">Like</button>
                        <span id="likes-count-{{ $post->id }}">{{ count($likes) }}</span>         
                        -->

                        @if ($post->website_user_id == Auth::user()->id)

                            <form action=" {{ route('newsfeed.edit', ['id'=>$post->id]) }}">
                                <button>Edit</button>
                            </form>
                        
                        @endif
                        
                        <div id="shit">

                            <like-component route=" {{ route ('api.newsfeed.likeIndex', ['id' => $post->id]) }} " S-F-W=" {{ $post->SFW }} "
                                id="likes-count-{{ $post->id }}"></like-component>

                            <div id="bullshit">
                                <button onclick="actOnLike(event);" data-chirp-id="{{ $post->id }}" type="subimt" class="btn btn-primary">@{{ Like }}</button>
                                <!--
                                <span id="likes-count-{{ $post->id }}">Total Likes: @{{ messages.length }}</span>
                                -->
                            </div>

                            <br>
                            <br>
                            <span>Comments:</span>
                            <br>

                            <comment-component route=" {{ route ('api.newsfeed.commentIndex', ['id' => $post->id]) }} "
                                post-id="{{ $post->id }}" user-name=" Bitch " current-user="{{ Auth::user()->id }}" id="comments-{{ $post->id }}">
                            </comment-component>


                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var app = new Vue({
        el: "#bullshit",
        data: {
            Like: "Like",
            messages: [],
        },
        mounted(){
            axios.get("{{ route ('api.newsfeed.likeIndex', ['id' => 1]) }}")
            .then( response => {
                this.messages = response.data;
                //alert(this.messages[0].id);
                //Vue.set(this.messages, 2, 'Bullshit');
            })
            .catch(response => {
                console.log(response);
            })
        },
    })

    var updateLikeStats = {
            Like: function (post_id) {
                var txt = document.querySelector('#likes-count-' + post_id).textContent;
                var numb = txt.replace(/[^0-9]/g,'');
                numb++;
                document.querySelector('#likes-count-' + post_id).textContent = "Total Likes: " + numb;
            },

            Unlike: function(post_id) {
                var txt = document.querySelector('#likes-count-' + post_id).textContent;
                var numb = txt.replace(/[^0-9]/g,'');
                numb--;
                document.querySelector('#likes-count-' + post_id).textContent = "Total Likes: " + numb;
            }
        };

    var toggleButtonText = {
        Like: function(button) {
            button.textContent = "Unlike";
        },

        Unlike: function(button) {
            button.textContent = "Like";
        }
    };

    var actOnLike = function (event) {
            var post_id = event.target.dataset.chirpId;
            console.log('post_id: ' + post_id);
            var action = event.target.textContent;
            toggleButtonText[action](event.target);
            updateLikeStats[action](post_id);
            console.log('action: ' + action);
            axios.post("/like/" + post_id + "/act",
                { action: action });
        };

</script>
@endsection('script')