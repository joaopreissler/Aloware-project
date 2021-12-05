<template>
<div class="panel-body container">
   <form  method="post"  @submit.prevent="AddComment(comment.name, comment.content)">
      <label>Name:</label>
      <input type="text" v-model="comment.name" />
      <textarea class="form-control" v-model="comment.content" placeholder="Say something cool" rows="3"></textarea>
      <br>
      <button type="submit" class="btn btn-info pull-right">Send</button>
   </form>
   <div class="media-body container" v-for="comment in results" style="background-color:blanchedalmond;">
    
      <comments-component 
         :name="comment.name"
         :created="comment.created_at"
         :comment="comment.comment"
         :commentid="comment.id"
         :replies="comment.replies">
      </comments-component>
   </div>
   <hr>
</div>
    
</template>

<script>
    export default{
        data(){
            return {
                
                url: 'http://127.0.0.1:8000/',
                results: [],
                comment:{
                name: '',
                content: ''
                    },
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
       created() {
            this.loadComments();
            Fire.$on('AfterCreated',() =>{
                this.loadComments();
                this.comment.name = ""
                this.comment.content = ""
            });
            
        },
        methods: {
            AddComment(){
                
               axios.post(this.url + 'AddComments', this.comment)
                .then(response => console.log(response))
                .catch(error => console.log(error));
            Fire.$emit('AfterCreated');
            
            },
           
            loadComments(){
                axios.get(this.url + 'GetComments')
                .then(response => this.results = response.data);
                 
            }
        }
    }
</script>
