<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Session;
use App\User;
use App\Post;
use App\Comment;
use App\UserDetail;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('sentinel');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Sentinel::getUser()->id;
        $post = User::with('posts')
            ->join('user_details', 'users.id', '=', 'user_details.user_id')
            ->join('posts', 'posts.user_id', '=', 'users.id')
            ->where('users.id', $id)
            ->orderBy('posts.created_at', 'desc')
            ->get();

        $foto = User::find($id)->userdetail()->first();

        
        /*dd($post);*/
        return view('user.index')->with(array('posting' => $post, 'foto' => $foto));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = Post::with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('user.create')->with('posting', $post);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Post::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datauser = User::find($id)->userdetail()->first();
        /*$biouser = UserDetail::with('user_id',$id)->get();*/


        /*dd($datauser);*/
        return view('user.edit')->with(array('user' => $datauser));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = Sentinel::getUser()->id;
        Post::where('id', $id)
            ->where('user_id', $user_id)
            ->delete();
        return redirect()->route('user.index');
    }

    public function comment(Request $request){

        $post = new Comment();
        $post->post_id = $request->post_id;
        $post->comment = $request->comment;
        $post->full_name = $request->full_name;
        $post->save();
        return response()->json($post);

        /*Comment::create($request->all());
        return redirect()->back();*/
    }

    public function get_comment($id){
        $user_id = Sentinel::getUser()->id;
        $comment = Comment::with('post')
            ->join('posts', 'posts.id', '=', 'comments.post_id')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->where('comments.post_id', '=', $id)
            ->orderBy('comments.created_at', 'desc')
            ->get();

        /*dd($comment);*/
     

        return response()->json($comment);
    }

    public function bio_store(Request $request){
        
        /*return dd($request);*/

        /*$validation = $this->validate($request, [
            'user_id' => 'required', 
            'alamat' => 'required|max:255', 
            'jenkel' => 'required', 
            'nohp' => 'required|numeric', 
            'ttl' => 'required', 
            'hobi' => 'required', 
            'foto' => 'required|mimes:jpg,png|min:1|max:10000',
        ]);

        if($validation->fails()){
            return redirect()->back();
        }
*/


        $image = new UserDetail;

        $file = $request->file('foto');

        

        $path = 'upload/';
        $filename = str_random(6).'_'.$file->getClientOriginalName();
        $file->move($path, $filename);

        $image->foto = $path.$filename;
        $image->user_id = $request->input('user_id');
        $image->alamat = $request->input('alamat');
        $image->jenkel = $request->input('jenkel');
        $image->nohp = $request->input('nohp');
        $image->ttl = $request->input('ttl');
        $image->hobi = $request->input('hobi');

        $image->save();

        return redirect('/');
    }

    public function bio_update(Request $id, $request){
        UserDetail::find($id)->update($request->all());
        return redirect()->back();
    }
}
