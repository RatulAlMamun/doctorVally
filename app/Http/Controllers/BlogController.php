<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $allBlogs = auth()->user()->blogs;
        return response()->json([
            'error' => false,
            'message' => 'All blog show',
            'data' => $allBlogs
        ]);
    }

    public function store(StoreBlogRequest $request)
    {
        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => auth()->id(),
            'publish' => $request->input('publish'),
            'view' => 0,
            'share' => 0
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
                $data = [];
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
                    //image path parsing
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
                if(isset($request->publish))
                {
                    $data['publish'] = $request->input('publish');
                }
                if($data)
                {
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
                        'message' => 'There is no data to update!!'
                    ], 400);
                }
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
            if(auth()->id() == $blog->user_id)
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
                    'message' => 'Unauthorized Access!!'
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
}
