<?php
/**
 * PHP version 7.1
 *
 * @category Controller
 * @package  App
 * @author   Predrag Vlajkovic <predrag.vlajkovic@gmail.com>
 * @license  http://softwarepieces.com/licence Private owned
 * @link     http://softwarepieces.com/
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use App\Category;
use Purifier;
use Session;
use Image;

/**
 * PostsController
 *
 * @category Controller
 * @package  App
 * @author   Predrag Vlajkovic drPreAG <predrag.vlajkovic@gmail.com>
 * @license  http://softwarepieces.com/licence Private owned
 * @link     http://softwarepieces.com/
 */
class PostsController extends Controller
{
    private $minAuthRead=2;
    private $minAuthWrite=3;
    private $paginator;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');        
        $this->paginator = env('PAGINATOR', 20);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role < $this->minAuthRead) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }

        $posts = Post::orderBy('id', 'desc')->paginate($this->paginator);

        return view ('posts.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role < $this->minAuthWrite) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }

        $postCategories = Category::where('active',1)->orderBy('name')->pluck('name','id');

        return view('posts.create')
            ->with('postCategories',$postCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->role < $this->minAuthWrite) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }
        
        // validate the data
        $this->validate($request, array(
            'title'         => 'required|max:255',
            'category'      => 'required|integer',
            'body'          => 'required',
            'image'         => 'max:255'
        ));

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $postImage = Image::make($image);

            $filename = time(). '.' . $image->getClientOriginalExtension();
            $location = public_path('images/') . $filename;
            // max 600x600px for image
            if ($postImage->width() > 600) 
                $postImage->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            if ($postImage->height() > 600) 
                $postImage->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                });
            $postImage->save($location);
        }        

        // store in the database
        $post = new Post;

        $post->title = $request->title;
        $post->body = Purifier::clean($request->body);
        $post->creator = Auth::user()->id;
        $post->category = $request->category;
        if ($request->hasFile('image')) {
            $post->image = $filename;
        }
        $post->active = true;

        if ($post->save()) {
            Session::flash('success', 'The blog post was successfully saved!');
            return redirect()->route('posts.show', $post->id);
        } else {
            Session::flash('error', 'An error occured.');
            return redirect()->back();            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->role < $this->minAuthRead) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }

        $post = Post::find($id);
        return view('posts.show')
            ->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if ($post->creator <> Auth::user()->id or Auth::user()->role < $this->minAuthWrite) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }

        $postCategories = Category::where('active',true)->orderBy('name')->pluck('name','id');

        return view('posts.edit')
            ->with('post', $post)
            ->with('postCategories',$postCategories);
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
        $post = Post::findOrFail($id);
        $post->active = true;

        if ($post->creator <> Auth::user()->id or Auth::user()->role < $this->minAuthWrite) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }

        // validate the data
        $this->validate($request, array(
            'title'         => 'required|max:255',
            'category'      => 'required|integer',
            'body'          => 'required',
            'image'         => 'max:255'
        ));

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $postImage = Image::make($image);

            $filename = time(). '.' . $image->getClientOriginalExtension();
            $location = public_path('images/') . $filename;
            // max 600x600px for image
            if ($postImage->width() > 600) 
                $postImage->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            if ($postImage->height() > 600) 
                $postImage->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                });
            $postImage->save($location);
            $post->image = $filename;
        }        

        // store in the database
        $post->active = true;
        $post->title = $request->title;
        $post->body = Purifier::clean($request->body);
        $post->category = $request->category;

        if ($post->save()) {
            Session::flash('success', 'The blog post was successfully saved!');
            return redirect()->route('posts.show', $post->id);
        } else {
            Session::flash('error', 'An error occured.');
            return redirect()->back();            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
