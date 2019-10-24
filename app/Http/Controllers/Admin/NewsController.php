<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\News;

class NewsController extends Controller
{
    public function add()
    {
      return view('admin.news.create');
    }
    
    public function create(Request $request)
    {
      
      $validatedData = $request->validate([
        'title' => 'required',
        'body' => 'required',
        'image' => 'image',
        ]);
        
        $news = new News();
        $news->title = $validatedData['title'];
        $news->body = $validatedData['body'];
        
        if (isset($validatedData['image'])) {
          $path = $validatedData['image']->store('images');
          $news->image_path = basename($path);
        }
        $news->save();
      return redirect('admin/news/create');
    }
}

