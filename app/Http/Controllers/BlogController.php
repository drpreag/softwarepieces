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
use App\Blog;
use App\User;
use App\Category;
use Purifier;
use Session;
use Image;

/**
 * BlogController
 *
 * @category Controller
 * @package  App
 * @author   Predrag Vlajkovic drPreAG <predrag.vlajkovic@gmail.com>
 * @license  http://softwarepieces.com/licence Private owned
 * @link     http://softwarepieces.com/
 */
class BlogController extends Controller
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

        $posts = Blog::orderBy('id', 'desc')->paginate($this->paginator);

        return view ('blog.index')
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

        $blogCategories = Category::where('active',1)->orderBy('name')->pluck('name','id');

        return view('blog.create')
            ->with('blogCategories',$blogCategories);
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
            $blogImage = Image::make($image);

            $filename = time(). '.' . $image->getClientOriginalExtension();
            $location = public_path('images/') . $filename;
            // max 600x600px for image
            if ($blogImage->width() > 600) 
                $blogImage->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            if ($blogImage->height() > 600) 
                $blogImage->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                });
            $blogImage->save($location);
        }        

        // store in the database
        $blog = new Blog;

        $blog->title = $request->title;
        $blog->body = Purifier::clean($request->body);
        $blog->creator = Auth::user()->id;
        $blog->category = $request->category;
        if ($request->hasFile('image')) {
            $blog->image = $filename;
        }
        $blog->active = true;

        if ($blog->save()) {
            Session::flash('success', 'The blog post was successfully saved!');
            return redirect()->route('blog.show', $blog->id);
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

        $post = Blog::findOrFail($id);
        
        return view('blog.show')
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
        $post = Blog::findOrFail($id);

        if ($post->creator <> Auth::user()->id or Auth::user()->role < $this->minAuthWrite) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }

        $blogCategories = Category::where('active',true)->orderBy('name')->pluck('name','id');

        return view('blog.edit')
            ->with('post', $post)
            ->with('blogCategories',$blogCategories);
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
        $post = Blog::findOrFail($id);
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
            $blogImage = Image::make($image);

            $filename = time(). '.' . $image->getClientOriginalExtension();
            $location = public_path('images/') . $filename;
            // max 600x600px for image
            if ($blogImage->width() > 600) 
                $blogImage->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            if ($blogImage->height() > 600) 
                $blogImage->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                });
            $blogImage->save($location);
            $post->image = $filename;
        }        

        // store in the database
        $post->title = $request->title;
        $post->body = Purifier::clean($request->body);
        $post->category = $request->category;

        if ($post->save()) {
            Session::flash('success', 'The blog post was successfully saved!');
            return redirect()->route('blog.show', $post->id);
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
