<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Photo;
use App\Gallery;
use Session;
use DB;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($gallery_id)
    {  
        $photos = Photo::all();
       return view('photo/create', compact('gallery_id')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {           
                $gallery_id = $request->input('gallery_id');
                $title = $request->input('title');
                $description = $request->input('description');
                $location = $request->input('location');
                $image = $request->file('image');
                $owner_id = 1;

                if($image){
                    $image_filename = $image->getClientOriginalName();
                    $image->move(public_path('images'), $image_filename);
                } else {
                    $image_filename = 'noimage.jpg';
                }

                DB::table('photos')->insert(
                    [
                        'title' => $title,
                        'description' => $description,
                        'location' => $location,
                        'gallery_id' => $gallery_id,
                        'image' => $image_filename,
                        'owner_id' => $owner_id
                    ]

                );

                Session::flash('message', 'Photo added');

                return \Redirect::route('gallery.show', ['id' => $gallery_id])->with('message', 'Gallery Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo = Photo::find($id);

        return view('photo/show')->withPhoto($photo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
