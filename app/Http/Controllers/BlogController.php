<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\User;

class BlogController extends Controller
{
    public function store(StoreBlogRequest $request)
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

    public function update(UpdateBlogRequest $request, $id)
    {
        $blog = Blog::find($id);
        if($blog)
        {
            if(auth()->id() == $blog->user_id)
            {
                if($request->title)
                {
                    $data['title'] = $request->input('title');
                }
                if($request->description)
                {
                    $data['description'] = $request->input('description');
                }
                if($request->hasFile('thumbnail'))
                {
                    $oldImageUrl = $blog->thumbnail;
                    $oldImageWithSlash = parse_url($oldImageUrl)['path'];
                    $oldImage = substr($oldImageWithSlash, 1);
                    if($oldImage)
                    {
                        unlink($oldImage);
                    }
                    $thumbnail = $request->file('thumbnail');
                    $newThumbnailName = time().'.'.$thumbnail->getClientOriginalExtension();
                    $path = public_path('/uploads/blogs');
                    $thumbnail->move($path, $newThumbnailName);
                    $data['thumbnail'] = $newThumbnailName;
                }

                $blog->update($data);
                return response()->json([
                    'error' => false,
                    'message' => 'Blog updated successfully!!',
                    'data' => $blog
                ]);
            }
            else
            {
                return response()->json([
                    'error' => true,
                    'message' => 'Unauthorize access!!'
                ], 401);
            }
        }
        else
        {
            return response()->json([
                'error' => true,
                'message' => 'Blog not found'
            ], 404);
        }
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        if($blog)
        {
            return response()->json([
                'error' => false,
                'message' => 'Single blog show',
                'data' => $blog
            ]);
        }
        else
        {
            return response()->json([
                'error' => true,
                'message' => 'Blog not found'
            ], 404);
        }
    }
}
