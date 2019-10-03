<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function add()
    {
      return view('admin.profile.create');
    }
    
    public function create()
    {
      return redirect('admin/profile/create');
    }
    
    public function edit()
    {
      return view('admin.profile.create');
    }
    
    public function update()
    {
      return redirect('admin/profile/edit');
    }
}


Route::group(['prefix' => 'admin'], function() {
  Route::get('profile/create','ProfileController@add');
});

Route::group(['prefix' => 'edit'], function() {
  Route::get('profile/create','ProfileController@edit');
});