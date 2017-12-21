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

        $post2 = User::with('posts')
            ->join('posts', 'posts.user_id', '=', 'users.id')
            ->where('users.id', $id)
            ->orderBy('posts.created_at', 'desc')
            ->get();
            

        $foto = User::find($id)->userdetail()->first();

        
        /*dd($foto);*/
        return view('user.index')->with(array('posting' => $post, 'foto' => $foto, 'postingnonfoto' => $post2));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Sentinel::getUser()->id;
        $post = Post::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        $foto = User::find($id)->userdetail()->first();
        /*$post2 = \DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->join('user_details', 'users.id', '=', 'user_details.user_id')
            ->select('posts.*', 'users.first_name', 'user_details.foto')
            ->orderBy('posts.created_at', 'desc')
            ->get();*/

        /*dd($post2);*/

        return view('user.create')->with(array('posting' => $post, 'foto' => $foto));
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

        $post = User::with('posts')
            ->join('user_details', 'users.id', '=', 'user_details.user_id')
            ->join('posts', 'posts.user_id', '=', 'users.id')
            ->where('users.id', $id)
            ->orderBy('posts.created_at', 'desc')
            ->get();

        $post2 = User::with('posts')
            ->join('posts', 'posts.user_id', '=', 'users.id')
            ->where('users.id', $id)
            ->orderBy('posts.created_at', 'desc')
            ->get();
            
        $data = User::find($id);
        $foto = User::find($id)->userdetail()->first();

        
        /*dd($post2);*/
        return view('user.show')->with(array('posting' => $post, 'foto' => $foto, 'postingnonfoto' => $post2, 'user' => $data));
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

        $datauser2 = User::find($id);
        /*dd($datauser2);*/
        return view('user.edit')->with(array('user' => $datauser, 'user2' => $datauser2));
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

    public function bio_update(Request $request, $id){
        /*UserDetail::find($id)->update($request->all());*/

        /*dd($request);*/
        $file = $request->file('foto');



        $path = 'upload/';
        $filename = str_random(6).'_'.$file->getClientOriginalName();
        $file->move($path, $filename);

        $data = array(
            'foto' => $path.$filename,
            'alamat' => $request->input('alamat'),
            'jenkel' => $request->input('jenkel'),
            'nohp' => $request->input('nohp'),
            'ttl' => $request->input('ttl'),
            'hobi' => $request->input('hobi'),         
        );

        UserDetail::where('user_id', $id)
            ->update($data);

        return redirect()->back();
    }
}
