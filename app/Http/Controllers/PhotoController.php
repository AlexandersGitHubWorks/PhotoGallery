<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use App\Http\Requests\PhotoRequest;
use Auth;

class PhotoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
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
    public function store(PhotoRequest $request)
    {
        $data = $request->validated();

        // Save photo with binding to current User
        $user = Auth::user();
        $user->photos()->create($data);

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
        $photo = Photo::find($id);
        return view('photo.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PhotoRequest $request, $id)
    {
        $data = $request->validated();
        $user = Auth::user();

        $photo = Photo::find($id);
        $photo->img = $data['img'];
        $photo->name = $data['name'];
        if (isset($data['description']))
            $photo->description = $data['description'];
        $photo->save();

        return redirect()->route('user', ['id' => $user->id])->with('status', 'Photo was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        $user = Auth::user();

        if (isset($photo)) {
            $photo->delete();
            return redirect()->route('user', ['id' => $user->id])->with('status', 'Photo was deleted');
        }

        return redirect()->route('user', ['id' => $user->id])->with('status', 'Photo has not been deleted.');
    }
}
