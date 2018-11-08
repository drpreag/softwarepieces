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
use App\News as News;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;
use App\Category;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewNewsShared;

/**
 * NewsController
 *
 * @category Controller
 * @package  App
 * @author   Predrag Vlajkovic drPreAG <predrag.vlajkovic@gmail.com>
 * @license  http://softwarepieces.com/licence Private owned
 * @link     http://softwarepieces.com/
 */
class NewsController extends Controller
{
    private $minAuthRead=6;
    private $minAuthWrite=8;
    private $paginator;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            "all", "show_news"
        ]]);

        $this->paginator = env('PAGINATOR', 30);
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

        $news = News::where('active', true)
            ->where('approved', true)
            ->orderBy('id', 'desc')
            ->paginate($this->paginator);

        return view ('news.index')
            ->with('news', $news);
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

        $newzCategory = Category::where('active',true)->orderBy('name')->pluck('name', 'id');

        return view('news.create')
            ->with('newzCategory', $newzCategory);
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
        $this->validate(
            $request,
            array(
                'url'       => 'required|min:5|max:255',
                'slug'      => 'required|alpha_dash|min:5|max:255|unique:news',
                'title'     => 'required|min:5|max:128',
                'imgurl'    => 'max:255',
                'post'      => 'required|min:10|max:2048',
                'category'  => 'required|integer|min:0'
            )
        );

        // store new record
        $newz = new News;
        $newz->url = $request->url;
        $newz->slug = $request->slug;        
        $newz->title = $request->title;
        $newz->imgurl = $request->imgurl;
        $newz->post = $request->post;
        $newz->category = $request->category;        
        $newz->active = true;
        $newz->creator = Auth::user()->id;
        
        if ($newz->save()) {

            $editors = User::where('active', true)->where('role', '>=', 6)->get();            
            foreach ($editors as $editor) {
                Mail::to($editor->email)->queue(new NewNewsshared($editor, $newz));
            }            

            Session::flash('success', 'Newz succefully updated.');
            return redirect()->route('news.show', $newz->id);
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
        $newz = News::findOrFail($id);
        return view('news.show')
            ->with('newz', $newz);        
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $slug
     * @return \Illuminate\Http\Response
     */    
    public function show_news($slug)
    {
        $newz = News::where('slug', $slug)->first();

        $previousSlug = null;
        $nextSlug = null;

        $prevNextNews = News::where('active', true)
            ->where('approved', true)
            ->where('id', '>', $newz->id)
            ->whereNotNull('slug')            
            ->orderBy('id', 'asc')
            ->first();

        if ($prevNextNews)
            $previousSlug = $prevNextNews->slug;

        $prevNextNews = News::where('active', true)
            ->where('approved', true)
            ->where('id', '<', $newz->id)
            ->whereNotNull('slug')            
            ->orderBy('id', 'desc')
            ->first();
        if ($prevNextNews)
            $nextSlug = $prevNextNews->slug;

        return view('news.show_news')
            ->with('newz', $newz)
            ->with('previousSlug', $previousSlug)
            ->with('nextSlug', $nextSlug);
    }    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $newz = News::findOrFail($id);

        if ($newz->creator <> Auth::user()->id or Auth::user()->role < $this->minAuthWrite) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }

        $collection = collect(
            [
                ['id'=>'0', 'name'=>'Inactive'],
                ['id'=>'1', 'name'=>'Active']
            ]);

        $newzStatus = $collection->pluck('name');
        $newzCategory = Category::where('active',true)->orderBy('name')->pluck('name', 'id');        

        return view('news.edit')
            ->with('newz', $newz)
            ->with('newzCategory', $newzCategory)
            ->with('newzStatus', $newzStatus);
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
        $newz = News::findOrFail($id);

        if ($newz->creator <> Auth::user()->id or Auth::user()->role < $this->minAuthWrite) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }
        // validate the data
        $this->validate(
            $request,
            array(
                'url'       => 'required|min:5|max:255',
                'slug'      => 'required|alpha_dash|min:5|max:255|unique:news,id,:'.$newz->id,
                'title'     => 'required|min:5|max:128',
                'imgurl'    => 'max:255',
                'post'      => 'required|min:10|max:2048',
                'category'  => 'required|integer',
                'active'    => 'required|integer|min:0|max:1'
            )
        );

        // update record
        $newz->exists = true;
        $newz->url = $request->url;
        $newz->slug = $request->slug;        
        $newz->title = $request->title;
        $newz->imgurl = $request->imgurl;
        $newz->post = $request->post;
        $newz->active = $request->active;
        $newz->category = $request->category;
        
        if ($newz->save()) {
            Session::flash('success', 'Newz succefully updated.');
            return redirect()->route('news.show', $id);
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
        $news = News::findOrFail($id);

        if ($news->creator <> Auth::user()->id or Auth::user()->role < $this->minAuthWrite) {
            Session::flash('error', 'You do not have authorization for this news.');
            return redirect()->route('news.index');
        }
        $news->exists = true;
        $news->active = false;

        if ($news->save()) {
            Session::flash('success', 'A News was sucessfully made inactive');
            return redirect()->route('news');
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

        $newsCategory = Category::where('active',true)
                        ->orderBy('name')
                        ->pluck('name', 'id');

        if (is_null($category)) {   
            $news = News::where('active', true)
                    ->where('approved', true)
                    ->whereNotNull('slug')
                    ->orderBy('id', 'desc')
                    ->paginate($this->paginator);
        } else {
            $news = News::where('active', true)
                    ->where('approved', true)
                    ->whereNotNull('slug')
                    ->where('category', $category)
                    ->orderBy('id', 'desc')
                    ->paginate($this->paginator);
        }

        return view ('news.all')
            ->with('news', $news)
            ->with('newsCategory', $newsCategory)
            ->with('category', $category);
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

        $newz = News::findOrFail($id);
        $newz->approved = true;
        // update model in the database
        if ($newz->save()) {
            Session::flash('success', 'The news article was successfully saved!');
            return redirect()->route('news.show', $newz->id);
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
    public function revoke_approve($id)
    {
        if (Auth::user()->role < $this->minAuthWrite) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }

        $newz = News::findOrFail($id);
        $newz->approved = false;
        // update model in the database
        if ($newz->save()) {
            Session::flash('success', 'The news article was successfully saved!');
            return redirect()->route('news.show', $newz->id);
        } else {
            Session::flash('error', 'An error occured.');
            return redirect()->back();            
        }
    }

}
