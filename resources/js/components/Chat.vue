<template>
    <div class="row">
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item" v-for="user of users" :key="user.id">{{user.name}}</li>
            </ul>
        </div>
        <div class="col-md-6">
            <div class="messages" ref="messages">
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
                message: '',
                users: []
            }
        },
        created() {
            window.Echo.join('chat.' + this.channel)
                .here((users) => {
                    this.users = Array.from(users);
                })
                .joining((user) => {
                    this.users.push(user);
                })
                .leaving((user) => {
                    this.users.splice(this.users.findIndex((item) => item.id === user.id), 1);
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
        updated() {
            // whenever data changes and the component re-renders, this is called.
            this.$nextTick(() => this.scrollToEnd());
        },
        methods: {
            sendMessage: function () {
                let data = {
                    user_id: this.user,
                    message: this.message
                };

                window.axios.post(`/channels/${this.channel}/messages`, data);

                this.message = '';
            },
            scrollToEnd: function () {
                // scroll to the start of the last message
                this.$refs.messages.scrollTop = this.$refs.messages.lastElementChild.offsetTop;
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
