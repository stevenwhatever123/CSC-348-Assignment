<template>
    <a style="color:rgb(250,0,0)" v-if="friendRequest.length + likes.length + comments.length> 0">
        Unread: {{ friendRequest.length + likes.length + comments.length}}</a>
</template>

<script>
    export default {
        name: 'user-component',
        props: ['route', 'likeRoute', 'commentRoute'],
        data(){
            return{
                friendRequest: [],
                likes: [],
                comments: []
            }
        },
        methods: {
            readFriendRequest: function(route){
                axios.get(route)
                .then( response => {
                    this.friendRequest = response.data;
                })
                .catch(response => {
                    console.log(response);
                    console.log("Failed");
                })
            },

            readLike: function(likeRoute){
                axios.get(likeRoute)
                .then( response => {
                    this.likes = response.data;
                })
                .catch(response => {
                    console.log(response);
                    console.log("Failed");
                })
            },

            readComment: function(commentRoute){
                axios.get(commentRoute)
                .then( response => {
                    this.comments = response.data;
                })
                .catch(response => {
                    console.log(response);
                    console.log("Failed");
                })
            }
        },
        mounted(){
            this.readFriendRequest(this.route)
            this.readLike(this.likeRoute)
            this.readComment(this.commentRoute)
        }
    }
</script>