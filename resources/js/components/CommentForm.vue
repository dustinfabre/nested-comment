<template>
    <el-form label-position="top" :model="comment" class="demo-form-inline">
        <el-form-item label="Name">
            <el-input ref="commentName" :autofocus="true" v-model="comment.user"></el-input>
        </el-form-item>
        <el-form-item label="Leave a Comment">
            <el-input
                type="textarea"
                :rows="3"
                v-model="comment.comment">
            </el-input>
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="submit()" style="float: right">{{ this.action == 'reply' ? 'Add Reply' : 'Add Comment' }}</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    export default {
        props: {
            action: {
                type: String,
                default: 'comment'
            },
            parent_id: {
                type: Number,
                default: 0
            }
        },

        data() {
            return {
                comment: {
                    user: '',
                    comment: '',
                }
            }
        },

        methods: {
            submit() {
                if(this.action == 'reply') {
                    this.addReply();
                } else {
                    this.addComment();
                }
            },

            addComment() {
                axios.post('api/add-comment', this.comment)
                .then(response => {
                    this.comment = { user: '', comment: '' }
                    this.pushComment(response.data.comment)
                })
            },

            addReply() {
                axios.post('api/add-reply', {
                    user: this.comment.user,
                    comment: this.comment.comment,
                    parent_id: this.parent_id
                })
                .then(response => {
                    this.comment = { user: '', comment: '' }
                    this.pushReply(response.data.comment)
                })
            }
        },
        inject: ['pushComment', 'pushReply']
    }
</script>
