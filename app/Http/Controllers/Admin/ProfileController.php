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
    
    
    public function edit()
    {
      return view('admin.profile.edit');
    }
    
    public function update()
    {
      return redirect('admin/profile/edit');
    }
}
