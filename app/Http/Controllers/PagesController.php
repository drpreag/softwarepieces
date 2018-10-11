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
        $category = $request->category;

        $newsCategory = Category::where('active',true)->orderBy('name')->pluck('name', 'id');

        if (is_null($category)) {   
            $news = News::where('active', true)->where('approved', true)->orderBy('id', 'desc')->paginate($this->paginator);
        } else {
            $news = News::where('active', true)->where('approved', true)->where('category', $category)->orderBy('id', 'desc')->paginate($this->paginator);
        }

        return view ('news.all')
            ->with('news', $news)
            ->with('newsCategory', $newsCategory)
            ->with('category', $category);      
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAbout()
    {
        return view('pages.about');
    }    

}
