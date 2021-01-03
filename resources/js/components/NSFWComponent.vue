<template>

</template>

<script>
    export default {
        name: 'nsfw-component',
        props: ['route'],
        data(){
            return{
                messages: [],
            }
        },
        methods: {
            readPost: function(route){
                axios.get(route)
                .then( response => {
                    this.messages = response.data;
                })
                .catch(response => {
                    console.log(response);
                    console.log("Failed");
                })
            },
        },
        mounted(){
            this.readPost(this.route);
            if(messages.SFW == false){
                alert("This post is not safe from work(SFW) please make sure no one is near by when reading");
            }
        }
    }
</script>