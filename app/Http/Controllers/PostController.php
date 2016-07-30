<?php
namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller 
{

	public function getDashboard(){
		
		$posts = Post::orderBy('created_at', 'desc')->get();
		return view('dashboard', compact('posts', 'user_array'));
	
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
		return redirect()->route('dashboard')->with([ 	'message'		=> 'Post was successfully deleted!!',
														'alert_style' 	=> 'alert-success'] );
	
	}

}