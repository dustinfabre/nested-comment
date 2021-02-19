<template>
    <div>
        <div>
            <span style="line-height: 5">Comments</span>
            <div class="block">
                <el-timeline>
                    <el-timeline-item :timestamp="comment.created_at" placement="top" v-for="(comment, index) in comments" :key="'comment_' + index">
                        <el-card>
                            <h4>{{ comment.user }}</h4>
                            <p>{{ comment.comment }}</p>
                            <el-button type="info" @click="showReply(comment)">Reply</el-button>
                            <comment-form action="reply" :parent_id="comment.id" v-show="replyingId == comment.id"></comment-form>
                            <div style="margin-bottom: 10px"></div>

                            <el-timeline>
                                <el-timeline-item :timestamp="comment.created_at" placement="top" v-for="(replies1, index) in comment.replies" :key="'comment1_' + index">
                                <el-card>
                                    <h4>{{ replies1.user }}</h4>
                                    <p>{{ replies1.comment }}</p>
                                    <el-button type="info" @click="showReply(replies1)">Reply</el-button>
                                    <comment-form action="reply" :parent_id="replies1.id" v-show="replyingId == replies1.id"></comment-form>
                                    <div style="margin-bottom: 10px"></div>

                                    <el-timeline>
                                        <el-timeline-item :timestamp="comment.created_at" placement="top" v-for="(replies2, index) in replies1.replies" :key="'comment1_' + index">
                                        <el-card>
                                            <h4>{{ replies2.user }}</h4>
                                            <p>{{ replies2.comment }}</p>
                                        </el-card>
                                        </el-timeline-item>
                                    </el-timeline>

                                </el-card>
                                </el-timeline-item>
                            </el-timeline>

                        </el-card>
                    </el-timeline-item>
                </el-timeline>
            </div>
        </div>

        <el-divider></el-divider>

        <comment-form></comment-form>

    </div>
</template>

<script>
import CommentForm from './CommentForm.vue'

    export default {
        components: {
            CommentForm
        },

        data() {
            return {
                comments: [],
                replyingId: 0,
                replying: []
            }
        },

        created() {
            this.getComments()
        },

        methods: {

            getComments() {
                axios.get('api/comments')
                .then(response => {
                    this.comments = response.data.comments
                })
            },

            pushComment(comment) {
                this.comments.unshift(comment)
            },

            pushReply(comment) {
                this.replying.replies.unshift(comment);
            },

            showReply(comment) {
                this.replying = comment
                this.replyingId = comment.id
            }
        },

        provide () {
            return {
                pushComment: this.pushComment,
                pushReply: this.pushReply
            }
        }
    }
</script>
