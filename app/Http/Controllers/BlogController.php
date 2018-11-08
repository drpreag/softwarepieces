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
// use Image;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewBlogPost;

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
        $this->middleware('auth', ['except' => [
            'all', 'show_blog'
        ]]);

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
            'subtitle'      => 'max:1024',
            'category'      => 'required|integer',
            'body'          => 'required',
            'keywords'      => 'max:127',
            'slug'          => 'required|alpha_dash|min:5|max:127|unique:posts',
            'image'         => 'max:2048|mimes:jpg,jpeg,bmp,png,gif'
        ));

        $post = new Blog;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $blogImage = Image::make($image);

            $filename = time(). '.' . $image->getClientOriginalExtension();
            $location = public_path('images/') . $filename;
            // max 400x400px for image
            if ($blogImage->width() > 400) 
                $blogImage->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            if ($blogImage->height() > 400) 
                $blogImage->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                });
            $blogImage->save($location);
            $post->image = $filename;
        }        

        // store in the database
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->body = Purifier::clean($request->body);
        $post->creator = Auth::user()->id;
        $post->category = $request->category;
        $post->keywords = $request->keywords;
        $post->slug = $request->slug;
        $post->active = true;

        if ($post->save()) {
            $editors = User::where('active', true)->where('role', '>=', 6)->get();
            foreach ($editors as $editor) {
                Mail::to($editor->email)->queue(new NewBlogPost($editor, $post));
            }
            Session::flash('success', 'The blog post was successfully saved!');
            return redirect()->route('blog.show', $post->id);
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
        $post_max_size = (int) filter_var(ini_get('post_max_size'), FILTER_SANITIZE_NUMBER_INT) * 1024 * 1024;
        $content_length = $request->server('HTTP_CONTENT_LENGTH') ?: $request->server('CONTENT_LENGTH') ?: 0;

        if ($content_length > $post_max_size) {
            Session::flash('error', 'Upload size too big.');
            return redirect()->back();              
        }

        $post = Blog::findOrFail($id);

        if ($post->creator <> Auth::user()->id or Auth::user()->role < $this->minAuthWrite) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }

        // validate the data
        $this->validate($request, array(
            'title'         => 'required|max:255',
            'subtitle'      => 'max:1024',            
            'category'      => 'required|integer',
            'body'          => 'required',
            'keywords'      => 'max:127',
            'slug'          => 'required|alpha_dash|min:5|max:127|unique:posts,id,:'.$post->id,
            'image'         => 'max:2048|mimes:jpg,jpeg,bmp,png,gif'
        ));

        if ($request->hasFile('image')) {        
            $image = $request->file('image');
            $blogImage = Image::make($image->getRealPath());
            $filename = time(). '.' . $image->getClientOriginalExtension();
            $location = public_path('images/') . $filename;
            // max 400x400px for image
            if ($blogImage->width() > 400) 
                $blogImage->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            if ($blogImage->height() > 400) 
                $blogImage->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

            $blogImage->save($location);
            $post->image = $filename;
        }        

        // store in the database
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->body = Purifier::clean($request->body);
        $post->category = $request->category;
        $post->keywords = $request->keywords;
        $post->slug = $request->slug;
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $post = Blog::findOrFail($id);

        if ($post->creator <> Auth::user()->id or Auth::user()->role < $this->minAuthWrite) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }
        // update model in the database
        if (Blog::destroy($id)) {
            Session::flash('success', 'The blog post was successfully deleted!');
            return redirect()->route('blog');
        } else {
            Session::flash('error', 'An error occured.');
            return redirect()->back();            
        }
    }

    /**
     * Public routes
     *
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $category = $request->category;

        $newsCategory = Category::where('active',true)->orderBy('name')->pluck('name', 'id');

        if (is_null($category)) {   
            $posts = Blog::where('active', true)
                ->where('approved', true)
                ->whereNotNull('slug')
                ->orderBy('id', 'desc')
                ->paginate($this->paginator);
        } else {
           $posts = Blog::where('active', true)
                ->where('approved', true)
                ->whereNotNull('slug')                
                ->where('category', $category)
                ->orderBy('id', 'desc')
                ->paginate($this->paginator);
        }

        return view ('blog.all')
            ->with('posts', $posts)
            ->with('newsCategory', $newsCategory)
            ->with('category', $category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_blog($slug)
    {
        $post = Blog::where('slug', $slug)
            ->where('active', true)
            ->where('approved', true)
            ->first();

        $previousSlug = null;
        $nextSlug = null;

        $prevNextBlog = Blog::where('active', true)
            ->where('approved', true)
            ->where('id', '>', $post->id)
            ->whereNotNull('slug')            
            ->orderBy('id', 'asc')
            ->first();
        if ($prevNextBlog)
            $previousSlug = $prevNextBlog->slug;

        $prevNextBlog = Blog::where('active', true)
            ->where('approved', true)
            ->where('id', '<', $post->id)
            ->whereNotNull('slug')            
            ->orderBy('id', 'desc')
            ->first();
        if ($prevNextBlog)
            $nextSlug = $prevNextBlog->slug;

        return view('blog.show_blog')
            ->with('post', $post)
            ->with('previousSlug', $previousSlug)
            ->with('nextSlug', $nextSlug);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        if (Auth::user()->role < $this->minAuthWrite) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }

        $post = Blog::findOrFail($id);
        $post->approved = true;
        // update model in the database
        if ($post->save()) {
            Session::flash('success', 'The blog post was successfully saved!');
            return redirect()->route('blog.show', $post->id);
        } else {
            Session::flash('error', 'An error occured.');
            return redirect()->back();            
        }
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function revoke_approval($id)
    {
        if (Auth::user()->role < $this->minAuthWrite) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }

        $post = Blog::findOrFail($id);
        $post->approved = false;
        // update model in the database
        if ($post->save()) {
            Session::flash('success', 'The blog post was successfully saved!');
            return redirect()->route('blog.show', $post->id);
        } else {
            Session::flash('error', 'An error occured.');
            return redirect()->back();            
        }
    }        
}
