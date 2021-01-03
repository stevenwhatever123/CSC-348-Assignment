<template>
    <span>Total Likes: {{ messages.length }}</span>
</template>

<script>
    export default {
        name: 'like-component',
        props: ['route', 'SFW'],
        data(){
            return{
                messages: []
            }
        },
        methods: {
            readData: function(route){
                axios.get(route)
                .then( response => {
                    console.log("before: " + this.messages);
                        this.messages = response.data;
                        console.log("after: " + this.messages);
                        console.log(response.data);
                        //alert(this.messages[0].id);
                        //Vue.set(this.messages, 2, 'Bullshit');
                })
                .catch(response => {
                    console.log(response);
                    console.log("Failed");
                })
            }
        },
        mounted(){
            if(this.SFW == false){
                alert("WARNING: This post is not safe from work(SFW) please make sure no one is near by when reading");
            }
            this.readData(this.route)
        }
    }
</script>