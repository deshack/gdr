<template>
    <div class="row">
        <div class="col-md-4">
            <md-list>
                <md-list-item v-for="user of users" :key="user.id">
                    <md-icon>person</md-icon>
                    <span class="md-list-item-text">{{user.name}}</span>
                </md-list-item>
            </md-list>
        </div>
        <div class="col-md-6">
            <div class="messages" ref="messages">
                <md-card v-for="message of messages" :key="message.id">
                    <md-card-content>
                        <strong v-if="message.user">{{message.user.name}}</strong>
                        <span>{{message.message}}</span>
                    </md-card-content>
                </md-card>
            </div>

            <md-field>
                <md-textarea v-model="message" placeholder="Scrivi..." md-autogrow></md-textarea>
                <md-button class="md-icon-button md-primary" @click="sendMessage">
                    <md-icon>send</md-icon>
                </md-button>
            </md-field>
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
                    this.messages.push(e);
                });

            window.axios.get(`/channels/${this.channel}/messages`)
                .then(response => {
                    console.debug(response);
                    this.messages = response.data.data;
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
                if (this.$refs.messages.lastElementChild) {
                    this.$refs.messages.scrollTop = this.$refs.messages.lastElementChild.offsetTop;
                }
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
