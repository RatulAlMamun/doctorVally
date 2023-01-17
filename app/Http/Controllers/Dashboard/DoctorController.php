<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDoctorImageRequest;
use App\Http\Requests\UpdateDoctorProfileRequest;

class DoctorController extends Controller
{
    public function update(UpdateDoctorProfileRequest $request)
    {
        $user = auth()->user();
        if($user->hasRole('doctor'))
        {
            $userData = [];
            $doctorData = [];
            if($request->email)
            {
                $userData['email'] = $request->input('email');
            }
            if($request->phone)
            {
                $userData['phone'] = $request->input('phone');
            }
            if($request->gender)
            {
                $doctorData['gender'] = $request->input('gender');
            }
            if($request->address)
            {
                $doctorData['address'] = $request->input('address');
            }
            if($request->bio)
            {
                $doctorData['bio'] = $request->input('bio');
            }
            if($request->treat_summary)
            {
                $doctorData['treat_summary'] = $request->input('treat_summary');
            }
            if($request->facebook)
            {
                $doctorData['facebook'] = $request->input('facebook');
            }
            if($request->youtube)
            {
                $doctorData['youtube'] = $request->input('youtube');
            }
            if($request->linkedin)
            {
                $doctorData['linkedin'] = $request->input('linkedin');
            }
            if($request->twitter)
            {
                $doctorData['twitter'] = $request->input('twitter');
            }
            if($request->specialities)
            {
                $user->userDetails->specialities()->sync($request->specialities);
            }
            if($userData)
            {
                $user->update($userData);
            }
            if($doctorData)
            {
                $user->userDetails()->update($doctorData);
            }
            return response()->json([
                'error' => false,
                'message' => 'Doctor updated successfully!!',
                'data' => [
                    'user' => $user,
                    'userDetails' => $user->userDetails
                ]
            ]);

        }
        return response()->json([
            'error' => true,
            'message' => 'Unauthorized Access!!'
        ], 401);
    }

    public function imageUpadate(UpdateDoctorImageRequest $request)
    {
        $user = auth()->user();
        $doctor = $user->userDetails;
        if($user->hasRole('doctor'))
        {
            $oldImage = $doctor->image;
            if($oldImage)
            {
                unlink('uploads/doctors/'.$oldImage);
            }
            $image = $request->file('image');
            $newImageName = time().'.'.$image->getClientOriginalExtension();
            $path = public_path('/uploads/doctors');
            $image->move($path, $newImageName);
            $doctor->update(['image' => $newImageName]);
            return response()->json([
                'error' => false,
                'message' => 'Profile Image updated successfully!!',
                'data' => $user->userDetails
            ]);
        }
        return response()->json([
            'error' => true,
            'message' => 'Unauthorized Access!!'
        ], 401);
    }
}
