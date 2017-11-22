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
use App\Role as Role;
use App\News as News;
use Session;

/**
 * UsersController
 *
 * @category Controller
 * @package  App
 * @author   Predrag Vlajkovic drPreAG <predrag.vlajkovic@gmail.com>
 * @license  http://softwarepieces.com/licence Private owned
 * @link     http://softwarepieces.com/
 */
class UsersController extends Controller
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

        $users = User::orderBy('id')->paginate($this->paginator);
        return view('users.index')->with('users',$users);
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

        $collection = collect(
            [
                ['id'=>'0', 'name'=>'Inactive'],
                ['id'=>'1', 'name'=>'Active']
            ]);

        $userStatus = $collection->pluck('name');
        $userRole = Role::pluck('name', 'id');

        return view('users.create')
            ->with('userRole', $userRole)
            ->with('userStatus', $userStatus);
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
                'email'     => 'required|email|unique:users|max:255',
                'name'      => 'required|max:255',
                'role'      => 'required|integer|min:1|max:9',
                'active'    => 'required|integer|min:0|max:1',
                'avatar'    => 'nullable|max:255'
            )
        );

        // store new record
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->active = $request->active;        
        $user->role = $request->role;
        $user->avatar = $request->avatar;
        $user->password = "@!@#$%%&*$%";

        if ($user->save()) {
            Session::flash('success', 'New user added.');
            return redirect()->route('users.show', $user->id);
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

        $user = User::findOrFail($id);

        $news = News::where('creator', $id)->orderBy('id', 'desc')->get();

        return view('users.show')
            ->with('user', $user)
            ->with('news', $news);
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

        $collection = collect(
            [
                ['id'=>'0', 'name'=>'Inactive'],
                ['id'=>'1', 'name'=>'Active']
            ]);

        $userStatus = $collection->pluck('name');
        $userRole = Role::pluck('name', 'id');
        $user = User::findOrFail($id);

        return view('users.edit')
            ->with('user', $user)
            ->with('userRole', $userRole)
            ->with('userStatus', $userStatus);
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
        // validate the data
        $this->validate(
            $request,
            array(
                'name' => 'required|max:255',
                'role'    => 'required|integer|min:1|max:9',
                'active'    => 'required|integer|min:0|max:1',
                'avatar'    => 'nullable|max:255'
            )
        );

        // update record
        $user = User::findOrFail($id);
        $user->exists = true;
        $user->name = $request->name;
        $user->active = $request->active;
        $user->role = $request->role;
        $user->avatar = $request->avatar;

        if ($user->save()) {
            Session::flash('success', 'User succefully updated.');
            return redirect()->route('users.show', $id);
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
    public function delete($id)
    {
        if (Auth::user()->role < $this->minAuthWrite) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }

        $user = User::findOrFail($id);

        if (Role::where('creator',$id)->count()>0) {
            Session::flash('error', 'This user can not be deleted, because there are other items related to this user.');
            return redirect()->back();           
        }

        if ($user->delete()) {
            Session::flash('success', 'User succefully deleted.');
            return redirect()->route('users.index');            
        } else {
            Session::flash('error', 'An error occured.');
            return redirect()->back();           
        }
    }
}
