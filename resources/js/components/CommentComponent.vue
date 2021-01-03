<template>
    <div>
        <input type="text" id="input" v-model="newCommentDescription">
        <button @click="createComment()">Send</button>

        <li v-for="comment in messages" track-by="created_at">
            <p>{{ comment.get_website_user.name }}: {{ comment.description }}  
            <button v-if="currentUser == comment.get_website_user.id" @click="onEditButtonClick(comment.id)">Edit</button></p>
        </li>
    </div>
</template>

<script>
    export default {
        name: 'comment-component',
        props: ['route', 'postId', 'userName', 'currentUser'],
        data(){
            return{
                messages: [],
                newCommentDescription: '',
            }
        },
        methods: {
            readData: function(route){
                axios.get(route)
                .then( response => {
                    console.log("before: " + this.messages);
                        this.messages = response.data;
                        console.log("Route: " + this.route);
                })
                .catch(response => {
                    console.log(response);
                    console.log("Failed");
                })
            },

            createComment: function(){
                axios.post("/comment/" + this.postId + "/act", {
                    description: this.newCommentDescription
                })
                .then(response => {
                    this.messages.push(response.data);
                    this.newCommentDescription = '';
                    console.log("Message: " + response.data);
                })
                .catch(response => {
                    console.log(response);
                    console.log("Comment Failed");
                })
            },

            onEditButtonClick: function(id){
                location.replace("/comment/" + id + "/edit");
            }
        },
        mounted(){
            this.readData(this.route)
        }
    }
</script>