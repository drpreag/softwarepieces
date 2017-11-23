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
use App\Role as Role;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;

/**
 * PagesController
 *
 * @category Controller
 * @package  App
 * @author   Predrag Vlajkovic drPreAG <predrag.vlajkovic@gmail.com>
 * @license  http://softwarepieces.com/licence Private owned
 * @link     http://softwarepieces.com/
 */
class RolesController extends Controller
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

        $roles = Role::all();

        return view ('roles.index')->with('roles', $roles);
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

        return view('roles.create');
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
                'name'                  => 'required|max:32',
                'description'           => 'max:128'
            )
        );

        $role = new Role;

        $role->name = $request->name;
        $role->description = $request->description;
        $role->creator = Auth::user()->id;
        $role->save();

        return redirect()->route('roles.index');
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

        $role = Role::findOrFail($id);
        $users = User::where('role',$id)->orderBy('name')->get();

        return view('roles.show')
            ->with('role', $role)
            ->with('users', $users);
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

        $role = Role::findOrFail($id);
        return view('roles.edit')->with('role', $role);
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
                'name'                  => 'required|max:32',
                'description'           => 'max:128'
            )
        );

        $role = Role::findOrFail($id);
        $role->exists = true;
        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();

        return redirect()->route('roles.show', $id);
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
     * @param int $id Ident of host
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        if (Auth::user()->role < $this->minAuthWrite) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }
        $role = Role::findOrFail($id);

        $user = User::where('role', $id);
        if ($user->count() > 0) {
            Session::flash('error', 'This role can not be deleted, because there are users with this role assigned.');
            return redirect()->back();            
        }

        $role->delete();

        Session::flash('success', 'User role deleted.');
        return redirect()->route('roles.index');
    }

}
