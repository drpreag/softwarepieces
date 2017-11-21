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
use App\User as User;
use App\Category as Category;
use Session;

/**
 * CategoriesController
 *
 * @category Controller
 * @package  App
 * @author   Predrag Vlajkovic drPreAG <predrag.vlajkovic@gmail.com>
 * @license  http://softwarepieces.com/licence Private owned
 * @link     http://softwarepieces.com/
 */
class CategoriesController extends Controller
{
    private $minAuthRead=3;
    private $minAuthWrite=8;
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

        $categories = Category::orderBy('sortid')->paginate($this->paginator);
        return view('categories.index')->with('categories',$categories);
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

        return view('categories.create');
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

        // validate the request data
        $this->validate(
            $request,
            array(
                'name'             => 'required|max:128',
                'sortid'           => 'required|integer|min:1|max:255'
            )
        );

        $category = new Category;

        $category->name = $request->name;
        $category->sortid = $request->sortid;
        $category->active = true;
        $category->creator = Auth::user()->id;
        $category->save();

        if ($category->save()) {
            Session::flash('success', 'New Category added.');
            return redirect()->route('categories.show', $category->id);
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

        $category = Category::findOrFail($id);

        return view('categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->role < $this->minAuthWrite) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }

        $category = Category::findOrFail($id);

        $collection = collect(
            [
                ['id'=>'0', 'name'=>'Inactive'],
                ['id'=>'1', 'name'=>'Active']
            ]);
        $categoryStatus = $collection->pluck('name');

        return view ('categories.edit')
            ->with ('category', $category)
            ->with ('categoryStatus', $categoryStatus);
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
        if (Auth::user()->role < $this->minAuthWrite) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }

        // validate the request data
        $this->validate(
            $request,
            array(
                'name'             => 'required|max:128',
                'sortid'           => 'required|integer|min:1|max:255',
                'active'    => 'required|integer|min:0|max:1'
            )
        );

        $category = Category::findOrFail($id);
        $category->exists=true;
        $category->name = $request->name;
        $category->sortid = $request->sortid;
        $category->active = $request->active;

        if ($category->save()) {
            Session::flash('success', 'Category updated.');
            return redirect()->route('categories.show', $category->id);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (Auth::user()->role < $this->minAuthWrite) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }

        $category = Category::findOrFail($id);

//        if (News::where('creator',$id)->count()>0) {
//            Session::flash('error', 'This category can not be deleted, because there are other items related to this record.');
//            return redirect()->back();           
//        }

        if ($category->delete()) {
            Session::flash('success', 'Category succefully deleted.');
            return redirect()->route('categories.index');            
        } else {
            Session::flash('error', 'An error occured.');
            return redirect()->back();           
        }
    }    
}
