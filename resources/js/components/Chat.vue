<template>
    <div>
        <div class="messages">
            <div class="card card-default mb-2" v-for="message of messages" :key="message.id"
                 :class="{'bg-light': (message.user_id === user)}">
                <div class="card-body">
                    {{message.message}}
                </div>
            </div>
        </div>

        <input type="text"
               class="form-control"
               placeholder="Scrivi un messaggio"
               v-model="message"
               @keyup.enter.prevent="sendMessage">
    </div>
</template>

<script>
    export default {
        props: {
            channel: {
                type: Number,
                required: true
            },
            user: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
                messages: {},
                message: ''
            }
        },
        created() {
            window.Echo.join('chat.' + this.channel)
                .here((users) => {
                    console.debug(users);
                })
                .joining((user) => {
                    console.log(user.name);
                })
                .leaving((user) => {
                    console.log(user.name);
                })
                .listen('MessagePushed', e => {
                    console.debug(e);
                    this.messages.push({
                        id: e.id,
                        user_id: e.user.id,
                        message: e.message
                    });
                });

            window.axios.get(`/channels/${this.channel}/messages`)
                .then(response => {
                    console.debug(response);
                    this.messages = response.data.data.map(message => {
                        return {
                            id: message.id,
                            user_id: message.user.id,
                            message: message.message
                        };
                    });
                });
        },
        methods: {
            sendMessage: function () {
                let data = {
                    user_id: this.user,
                    message: this.message
                };

                window.axios.post(`/channels/${this.channel}/messages`, data);

                this.message = '';
            }
        }
    }
</script>

<style scoped>
    .messages {
        max-height: 80vh;
        overflow-y: auto;
    }
</style>
