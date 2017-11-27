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
use App\User;
use App\News;
use App\Blog;
use App\Category;

/**
 * PagesController
 *
 * @category Controller
 * @package  App
 * @author   Predrag Vlajkovic drPreAG <predrag.vlajkovic@gmail.com>
 * @license  http://softwarepieces.com/licence Private owned
 * @link     http://softwarepieces.com/
 */
class PagesController extends Controller
{
    private $paginator;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->paginator = env('PAGINATOR', 20);         
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserError()
    {
        return view('pages.user_error');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDashboard(Request $request)
    {
        if (is_null($request->category)) {
            $news = News::where('active', true)->orderBy('created_at', 'desc')->paginate($this->paginator);
        } else {
            $news = News::where('active', true)->where('category',$request->category)->orderBy('created_at', 'desc')->paginate($this->paginator);
        }

        $newsCategory = Category::where('active',true)->orderBy('name')->pluck('name', 'id');

        return view('pages.dashboard')
                ->with('news', $news)
                ->with('newsCategory', $newsCategory);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNews(Request $request)
    {
        if (is_null($request->category)) {
            $news = News::where('active', true)->orderBy('created_at', 'desc')->paginate($this->paginator);
        } else {
            $news = News::where('active', true)->where('category',$request->category)->orderBy('created_at', 'desc')->paginate($this->paginator);
        }

        $newsCategory = Category::where('active',true)->orderBy('name')->pluck('name', 'id');

        return view('pages.news')
                ->with('news', $news)
                ->with('newsCategory', $newsCategory);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBlog(Request $request)
    {
        if (is_null($request->category)) {
            $posts = Blog::where('active', true)->orderBy('created_at', 'desc')->paginate($this->paginator);
        } else {
            $posts= Blog::where('active', true)->where('category',$request->category)->orderBy('created_at', 'desc')->paginate($this->paginator);
        }

        $blogCategory = Category::where('active',true)->orderBy('name')->pluck('name', 'id');

        return view('pages.blog')
                ->with('posts', $posts)
                ->with('blogCategory', $blogCategory);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLicence()
    {
        return view('pages.licence');
    }
}
