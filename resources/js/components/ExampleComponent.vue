<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <input type="text" v-model="message">
                    <button @click="sendMessage">Отправить сообщение в канал</button>
                </div>
            </div>
            <div class="col-md-12">
                <kinesis-container>
                    Here, you can put
                    <kinesis-element :strength="10">
                        <img class="paralax-image" src="https://sun9-44.userapi.com/impf/c622017/v622017379/4d704/peg4tB7irek.jpg?size=598x600&quality=96&proxy=1&sign=1256343fe696924b45fdbe8de5b31a14&type=album" alt="">
                    </kinesis-element>
                    <kinesis-element :strength="20">
                        <img class="paralax-image" src="https://sun9-59.userapi.com/impf/c622017/v622017379/4d70b/p-KAoRezdNw.jpg?size=598x600&quality=96&proxy=1&sign=2e30a9b5f0cadecd008ecbb0d711268a&type=album" alt="">
                    </kinesis-element>
                </kinesis-container>
            </div>
        </div>
    </div>
</template>

<script>
    import { KinesisContainer, KinesisElement} from "vue-kinesis"

    export default {
        components:{
            KinesisContainer, KinesisElement
        },
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

<style lang="scss">
    .paralax-image {
        width:100px;
        height:100px;
        object-fit: contain;
        position: absolute;
    }
</style>
