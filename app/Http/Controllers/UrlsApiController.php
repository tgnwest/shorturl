<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;

class UrlsApiController extends Controller
{

    protected $url;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Url $url)
    {
        $this->url = $url;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->url->getAllLinks());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json($this->url->store($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json($this->url->getUrlById($id));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json($this->url->deleteUrl($id));
    }
}
