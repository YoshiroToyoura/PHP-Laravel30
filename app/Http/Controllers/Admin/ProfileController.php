<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Profile;

use App\Profilehistory;

use Carbon\Carbon;

class ProfileController extends Controller
{
    //
    public function add()
    {
      return view('admin.profile.create');
    }
     
    public function create(Request $request)
    {
        $this->validate($request,Profile::$rules);
        
        $profiles = new Profile();
        $form = $request->all();
        
        unset($form['_token']);
        
        $profiles->fill($form);
        
//      $profiles->name = $form['name'];
//      $profiles->gender = $form['gender'];
//      $profiles->hobby = $form['hobby'];
//      $profiles->introduction = $form['introduction'];
        
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
      $profile = Profile::find($request->id);
      $profiles_form = $request->all();
      unset($profiles_form['_token']);
      $profile->fill($profiles_form)->save();
      
      $profilehistory = new Profilehistory;
      $profilehistory->profile_id = $profile->id;
      $profilehistory->edited_at = Carbon::now();
      $profilehistory->save();
      
      return redirect('admin/profile/edit?id='. $request->id);
    }
}
