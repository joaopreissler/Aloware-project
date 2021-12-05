<template>
   <div>
      <ul >
         <div class="media-body">
            <span class="text-muted pull-right">
            <small class="text-muted">{{created}}</small>
            </span>
            <strong class="text-success">{{name}}</strong>
            <p>
               {{content}}
            </p>
            <form  method="post" @submit.prevent="AddReplyNested(reply.name, reply.content, reply.comment)">
               <label>Name:</label>
               <input type="text"  v-model="reply.name" />
               
               <textarea class="form-control" v-model="reply.content" :placeholder="'Reply to ' + name" rows="3"></textarea>
               <input  v-model="reply.comment = commentid" type="hidden"></input>
               <button type="submit" class="btn btn-small btn-warning">Send</button>
            </form>
         </div>
         - 
      </ul>
      <ul v-for="item in replies">
         <ul>
            <div class="media-body">
               <span class="text-muted pull-right">
               <small class="text-muted">{{item.created_at}}</small>
               </span>
               <strong class="text-success">{{item.name}}</strong>
               <p>
                  {{item.comment}}
               </p>
            </div>
         </ul>
      </ul>
   </div>
</template>

<script>
    export default{
         props: {
                name: String,
                commentid: Number,
                created: String,
                content: String,
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
                results: [],
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
       
        methods: {
           
            AddReplyNested(){
                axios.post(this.url + 'NestedReply', this.reply)
                .then(response => console.log(response))
                .catch(error => console.log(error));
                Fire.$emit('AfterCreated');  
                this.reply.name = "";
                this.reply.content = "";
            }
        }
    }
</script>
