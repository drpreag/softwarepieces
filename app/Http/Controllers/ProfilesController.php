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
use Illuminate\Support\Facades\Auth;
use Image;

/**
 * ProfilesController
 *
 * @category Controller
 * @package  App
 * @author   Predrag Vlajkovic drPreAG <predrag.vlajkovic@gmail.com>
 * @license  http://softwarepieces.com/licence Private owned
 * @link     http://softwarepieces.com/
 */
class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //if (Auth::user()->id <> $id) {
        //    Session::flash('error', 'You do not have authorization for this action.');
        //    return redirect()->back();
        // }

        $user = User::findOrFail($id);

        return view('profiles.show')
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->id <> $id) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }

        $user = User::findOrFail($id);

        return view('profiles.edit')
            ->with('user', $user);
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
        if (Auth::user()->id <> $id) {
            Session::flash('error', 'You do not have authorization for this action.');
            return redirect()->back();
        }

        // validate the request data
        $this->validate(
            $request,
            array(
                'name'                  => 'required|max:32',
                'description'           => 'max:128',
                'avatar'                => 'max:255'
            )
        );

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarImage = Image::make($avatar);

            $filename = time(). '.' . $avatar->getClientOriginalExtension();
            $location = public_path('images/') . $filename;
            // max 300x200px for avatar
            if ($avatarImage->width() > 200) 
                $avatarImage->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            if ($avatarImage->height() > 300) 
                $avatarImage->resize(null, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
            $avatarImage->save($location);
        }

        $user = User::findOrFail($id);
        $user->exists = true;
        $user->name = $request->name;
        if ($request->hasFile('avatar')) {        
            $user->avatar = $filename;
        }

        if ($user->save()) {
            Session::flash('success', 'New user added.');
            return redirect()->route('profiles.show', id);
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
