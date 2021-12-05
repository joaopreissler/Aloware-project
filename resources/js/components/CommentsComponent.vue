<template>
   <div>
      <strong class="text-success">{{name}}</strong>
      <span class="text-muted pull-right">
      <small class="text-muted">{{created}}</small>
      </span>
      <p>
         {{comment}}
      </p>
      <form method="post" @submit.prevent="AddReply(reply.name, reply.content, reply.comment)">
        <label>Name:</label>
         <input type="text" v-model="reply.name" />
         <textarea class="form-control"  v-model="reply.content"  rows="3" :placeholder="'Reply to ' + name"></textarea>
         <input  v-model="reply.comment = commentid" type="hidden"></input>
         <button type="submit" class="btn btn-small btn-warning">Send</button>
      </form>
      <div v-for="item in replies">
      
      <reply-component :name="item.name"
      :content="item.comment"
      :created="item.created_at"
      :commentid="item.id"
      :replies="item.nested_replies"></reply-component>
      </div>
   </div>
</template>

<script>
    export default{
        props: {
                name: String,
                created: String,
                comment: String,
                commentid: Number,
                replies: [Object, Array]
             },
        data(){
            return {
                url: 'http://127.0.0.1:8000/',
                reply:{
                name: '',
                content: '',
                comment: ''
                    },
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        methods: {
           
            AddReply(){
                axios.post(this.url + 'ReplyComments', this.reply)
                .then(response => console.log(response))
                .catch(error => console.log(error));
                Fire.$emit('AfterCreated');
                this.reply.name = "";
                this.reply.content = "";
            }
        }
    }
</script>
