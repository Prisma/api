<?php

namespace App\Http\Controllers;

use App\Heritage;
use App\Http\Requests\Heritage as HeritageRequest;

class HeritageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\Heritage\Index  $request
     * @return \Illuminate\Http\Response
     */
    public function index(HeritageRequest\Index $request)
    {
        return response()->success(Heritage::all(), 200, 'OK');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Heritage\Store  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HeritageRequest\Store $request)
    {
        $heritage = new Heritage([
            'description' => $request->input('description'),
            'happened_at' => $request->input('happenedAt')
        ]);
        if (!$heritage->save()) {
            return response()->exception('The heritage could not be created', 500);
        }

        $location = $request->url() . '/' . $heritage->id;
        return response()->success($heritage, 201, 'Created', $location);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Requests\Heritage\Show $request
     * @param  int  $heritageId
     * @return \Illuminate\Http\Response
     */
    public function show(HeritageRequest\Show $reqeust, $heritageId)
    {
        $heritage = Heritage::findOrFail($heritageId);
        $gotHeritage = [
            'id' => $heritage->id,
            'filename' => $heritage->filename,
            'title' => $heritage->title,
            'description' => $heritage->description,
            'happened_in' => $heritage->happened_in,
        ];

        return response()->success($gotHeritage, 200, 'OK');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Heritage\Update $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HeritageRequest\Update $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\Heritage\Destroy $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(HeritageRequest\Destroy $request, $id)
    {
        //
    }
}