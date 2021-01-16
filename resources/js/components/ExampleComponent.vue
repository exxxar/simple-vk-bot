<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <input type="text" v-model="message">
                    <button @click="sendMessage">Отправить сообщение в канал</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
          return {
              message:''
          }
        },
        methods:{
          sendMessage(){
              axios
                .post("/api/send-message-to-bot",{
                    message:this.message
                }).then(resp=>{
                    this.message = '';
              })
          }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
