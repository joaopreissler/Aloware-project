<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Comments;
use App\Models\Comments_replies;
class CommentsController extends Controller
{
    public function Comments(){
      
        
        return view('welcome');
    }
    public function getcomments(){
          
        $comments = Comments::with('Replies.NestedReplies')
        ->orderBy('created_at', 'DESC')
        ->get();
        
        return response()->json($comments);
    }
   
    public function AddComments(Request $req){
        
        
        DB::table('comments')
        ->insert([
            'name' => $req->name,
            'comment' => $req->content,
            'created_at' => Carbon::now()
        ]);
        return ;
    }

    public function ReplyComments(Request $request){
        
      
        $comment_replies = DB::table('comments_replies')
        ->insert([

            'name' => $request->name,
            'comment' => $request->content,
            'created_at' => Carbon::now()   
            
        ]);
       
        $last_result = DB::table('comments_replies')->orderBy('created_at', 'desc')->first();
        
        DB::table('comments_replies_conn')
        ->insert([
            'comment_id' => $request->comment,
            'reply_id' => $last_result->id
            
        ]);
        return $request;
    }
    public function NestedReply(Request $request){
       
        DB::table('nested_replies')
        ->insert([
            'name' => $request->name,
            'comment' => $request->content,
            'created_at' => Carbon::now() 
            
        ]);
        $last_result = DB::table('nested_replies')->orderBy('created_at', 'desc')->first();

        DB::table('nested_replies_conn')
        ->insert([
            'reply_id' => $request->comment,
            'nested_id' => $last_result->id
            
        ]);
        return;
    }
}
