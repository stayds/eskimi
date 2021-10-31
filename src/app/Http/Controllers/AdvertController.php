<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advert;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Advert::Orderby('created_at','DESC')->get();
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
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'start_date' => 'required',
                'end_date' => 'required',
                'total_budget' => 'required',
                'daily_budget' => 'required'
            ], [
                'name.required' => 'Name field specified',
                'start_date.required' => 'Start Date specified',
                'end_date.required' => 'End Date was specified',
                'total_budget.required' => 'Total Budget was not specified',
                'daily_budget.required' => 'Daily Budget was not specified'
            ]);

            if ($request->file('files')) {

                $request->validate([
                    'images.*' => 'mimes:jpeg,png,jpg,gif,svg'
                ]);

                $files = $request->file('files');

                $images = $this->storeUpload($files);

                //instantiate advert model and create record
                $advertModel = new Advert();
                $advertModel->user_id = 1;
                $advertModel->name = $validated['name'];
                $advertModel->start_date = $validated['start_date'];
                $advertModel->end_date = $validated['end_date'];
                $advertModel->total_budget = $validated['total_budget'];
                $advertModel->daily_budget = $validated['daily_budget'];
                $advertModel->images = json_encode($images);
                $advertModel->save();

                return response()->json(['message' => "Advert successfully created"], 200);

            }

        }
        catch (Throwable $e){
            return response()->json(['message'=>'An error occured','error'=>$e], 500);
        }


    }

    //method that stores all uploaded images to a folder
    private function storeUpload($data){

        $imageList = [];
        $destinationPath = public_path().'/adverts';

        foreach($data as $file){

            $fileName = mt_rand(1,100).time() . '.'.$file->getClientOriginalExtension();
            $file->move( $destinationPath, $fileName);
            $fullPath = '/adverts/'.$fileName;
            array_push($imageList, $fullPath);
        }

        return $imageList;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record  =  Advert::find($id);
        return json_decode($record->images);
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
    public function destroy(Request $request, $id)
    {
        //
    }
}
