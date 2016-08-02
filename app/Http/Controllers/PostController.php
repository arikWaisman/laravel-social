<?php
namespace App\Http\Controllers;

use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller 
{

	public function getDashboard(){
		
		$posts = Post::orderBy('created_at', 'desc')->get();
		return view('dashboard', compact('posts'));
	
	}

	public function postCreatePost(Request $request){
		
		$this->validate($request, [
			'body' => 'required|max:1000'
		]);
		$post = new Post();
		$post->body = $request['body'];
		$message = 'There was an error';
		$alert_style = 'alert-danger';
		if( $request->user()->posts()->save($post) ){

			$message = 'Post successfully created!';
			$alert_style = 'alert-success';

		}
		return redirect()->route('dashboard')->with( compact( 'message', 'alert_style' ) );
	
	}

	public function getDeletePost($post_id){
		
		$post = Post::where('id', $post_id)->first();
		if( Auth::user() != $post->user ) { //I can access $post->user because of the hasMany relationship between User & Posts (it's defined auto)
			return redirect()->back();
		}
		$post->delete();
		return redirect()->route('dashboard')->with([ 	
			'message'		=> 'Post was successfully deleted!!',
			'alert_style' 	=> 'alert-success'
		]);
	
	}

	public function postEditPost(Request $request){

		$this->validate($request, [
			'body'	=> 'required'
		]);		
		$post = Post::find($request['postId']);
		if( Auth::user() != $post->user ) { //I can access $post->user because of the hasMany relationship between User & Posts (it's defined auto)
			return redirect()->back();
		}
		$post->body = $request['body'];
		$post->update();
		//you return the updated body text and send it to the front end so you can update the post in the collection list
		return response()->json(['new_body' => $post->body], 200); 	

	}

	public function postLikePost(Request $request){
		
		$post_id = $request['postId'];
		$is_like = $request['isLike'] === 'true' ? true : false; //can remove ternary operator to set varaible but its clearer with it.
		$update = false;
		$post = Post::find($post_id);
		if(!$post){ 
			return null;
		}
		$user = Auth::user();
		$like = $user->likes()->where('post_id', $post_id)->first(); 
		if($like){
			$already_like = $like->like; //if this returns true post is already liked and if false it's already disliked (checks Like table, 'like' column)
			$update = true;
			if($already_like == $is_like){ //if it was liked and you click like again you want to undo the like
				$like->delete();
				return null;
			}
		} else { //no existing value in the like column of the database and you need to create a new like and configure the values from the request
			$like = new Like();
		}
		//above new Like() configuration values
		$like->like = $is_like;
		$like->user_id = $user->id;
		$like->post_id = $post->id;
		if($update){
			$like->update(); //if you are changing the like to a dislike you update
		} else {
			$like->save(); //if you are liking the post for the first time it doesnt yet exist
		}
		return null;

	}

}