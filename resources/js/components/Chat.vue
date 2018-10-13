<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default" v-for="message of messages">
                    <div class="card-body">
                        {{message}}
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-body">
                        <input type="text"
                               class="input"
                               placeholder="Scrivi un messaggio"
                               v-model="message"
                               @keyup.enter.prevent="sendMessage">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                channel: '1',
                messages: [],
                message: ''
            }
        },
        created() {
            window.Echo.channel('chat.' + this.channel)
                .listen('MessagePushed', e => {
                    console.debug(e);
                    this.messages.push(e.message);
                });
        },
        methods: {
            sendMessage: function () {
                let endpoint = `/api/channels/${this.channel}/messages`;

                let data = {
                    // username: this.username,
                    message: this.message
                };

                window.axios.post(endpoint, data);

                this.message = '';
            }
        }
    }
</script>
