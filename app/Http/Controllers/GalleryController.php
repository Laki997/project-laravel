<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditGalleryRequest;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\Photo;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)

    {
        info($request);
        $term = $request->input('term');
        
      

        

        $galleries = Gallery::where('naziv',"like","%$term%")->orderBy('id','DESC')->with('photos')->with('user')->paginate(10);

        if (!$galleries){
           return;
        }

        return $galleries;

        

      

       

        

       

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $data = $request->validated();
 
        $user = auth('api')->user();
        
        $photos = [];
       
        foreach($data['inputs'] as $inputs){
            foreach($inputs as $value){

                $photos [] = $inputs;   
            }
            
        }
        
        $gallery = $user->galleries()->create(['naziv' => $data['naziv'], 'opis' => $data['opis']]);
       
      return $gallery->photos()->createMany($photos);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
     return Gallery::with('photos')->with('user')->with('comments')->find($id);

     
    
        
    
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
    public function update(EditGalleryRequest $request, $id)
    {

        info($request);
        $data = $request->validated();
        // $user =auth('api')->user();
        $gallery = Gallery::find($id);

        $gallery->naziv = $request->input('naziv');
        $gallery->opis = $request->input('opis');
        // $gallery->user_id = $user->id;

        $gallery->save();

        $gallery->photos()->delete();
        $imagesArray = $data['photos'];

        $images = [];
        
        foreach($imagesArray as $image){
            
           $newImage = new Photo($image);

           $images [] = $newImage;
            
        }
        
         $gallery->photos()->saveMany($images);

         return $gallery;
        

      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Gallery::find($id)->delete();
    }
}
