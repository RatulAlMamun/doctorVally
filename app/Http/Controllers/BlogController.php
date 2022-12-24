<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\User;

class BlogController extends Controller
{
    public function store(BlogRequest $request)
    {
        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => auth()->id()
        ];
        if($request->hasFile('thumbnail'))
        {
            $thumbnail = $request->file('thumbnail');
            $newThumbnailName = time().'.'.$thumbnail->getClientOriginalExtension();
            $path = public_path('/uploads/blogs');
            $thumbnail->move($path, $newThumbnailName);
            $data['thumbnail'] = $newThumbnailName;
        }
        $blog = Blog::create($data);
        return response()->json([
            'error' => 'false',
            'message' => 'Blog created successfully!!',
            'data' => $blog
        ], 201);
    }
}
