<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Profile;

class ProfileController extends Controller
{
    //
    public function add()
    {
      return view('admin.profile.create');
    }
     
    public function create(Request $request)
    {
       $validatedData = $request->validate([
        'name' => 'required',
        'gender' => 'required',
        'hobby' => 'required',
        'introduction' => 'required',
        ]);
        
        $profiles = new Profile();
        $profiles->name = $validatedData['name'];
        $profiles->gender = $validatedData['gender'];
        $profiles->hobby = $validatedData['hobby'];
        $profiles->introduction = $validatedData['introduction'];
        
        $profiles->save();
      return redirect('admin/profile/create');
      
    }
    
    
    public function edit(Request $request)
    {
      $profiles = Profile::find($request->id);
      if (empty($profiles)) {
        abort(404);
      }
      return view('admin.profile.edit',['profile_form' => $profiles]);
    }
    
    public function update(Request $request)
    {
      $this->validate($request,Profile::$rules);
      $profiles = Profile::find($request->id);
      $profiles_form = $request->all();
      unset($profiles_form['_token']);
      $news->fill($profiles_form)->save();
      
      return redirect('admin/profile');
    }
}
