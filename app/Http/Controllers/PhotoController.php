<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use App\Http\Requests\PhotoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Helpers\Contracts\PhotoFileContract;

class PhotoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'showOriginal']]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('photo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PhotoRequest $request, PhotoFileContract $photo_file)
    {
        $request->flash();

        $user = Auth::user();

        if ($image = $request->file('img')) {
            // Saving photo files and its cutting
            $photo_file->storePhoto($image);

            // Save photo in db with binding to current User
            $data = $request->validated();
            $data['img'] = $photo_file->image_name;
            $user->photos()->create($data);
        }

        return redirect()->route('user', ['id' => $user->id])->with('status', 'Photo was uploaded');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $photo = Photo::find($id);
        return view('photo.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Checking have user access to edit
        if (Gate::denies('author-policy', Photo::find($id))) {
            return redirect()->back()->with('message', 'You don\'t have access');
        }

        $photo = Photo::find($id);
        return view('photo.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PhotoRequest $request, PhotoFileContract $photo_file, $id)
    {
        // Checking have user access to edit
        if (Gate::denies('author-policy', Photo::find($id))) {
            return redirect()->back()->with('message', 'You don\'t have access');
        }

        $user = Auth::user();
        $photo = Photo::find($id);

        if ($image = $request->file('img')) {
            // Saving photo files and its cutting
            $photo_file->storePhoto($image);

            // Save photo in db
            $data = $request->validated();
            $photo->img = $photo_file->image_name;
            $photo->name = $data['name'];
            if (isset($data['description']))
                $photo->description = $data['description'];
            $photo->save();
        }

        return redirect()->route('user', ['id' => $user->id])->with('status', 'Photo was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Checking have user access to edit
        if (Gate::denies('author-policy', Photo::find($id))) {
            return redirect()->back()->with('message', 'You don\'t have access');
        }

        $photo = Photo::find($id);

        if (isset($photo)) {
            $photo->delete();
            return response()->json(['succeed' => 'true', 'message' => 'Photo was deleted']);
        }

        return response()->json(['succeed' => 'false', 'message' => 'Photo has not been deleted']);
    }

    /**
     * Display the original size Photo.
     */
    public function showOriginal($id)
    {
        $photo = Photo::find($id);
        return view('photo.show_original', compact('photo'));
    }
}
