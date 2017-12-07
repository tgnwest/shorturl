<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UrlsController extends Controller
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
     * Show the urls list.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        Log::info('Showing index page');
        $urls = $this->url->getAllLinks();
        return view('home')->with('urls', $urls);
    }

    /**
     * Show all user urls
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        Log::info('Showing user links page for user: '.Auth::id());
        $urls = $this->url->getAllUserLinks();
        return view('urls.index')->with('urls', $urls);
    }

    /**
     * Show the new short url form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        Log::info('Showing the new short url form for user: '.Auth::id());
        return view('urls.create');
    }

    /**
     * Create the nwe record in db
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $url = $this->url->store($request);
        Log::info('Stored data with id: '.$url->id.' in db by user: '.Auth::id());
        return redirect('/urls')->with('status', 'Url successfully created!');
    }

    /**
     * Delete record from db
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $this->url->deleteUrl($id);
        Log::info('Deleted data with id: '.$id.' in db by user: '.Auth::id());
        return back()->with('status', 'Url successfully deleted!');
    }

    /**
     * Share or hidden url on index page
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function share($id)
    {
        $msg = $this->url->shareUrl($id);
        Log::info($msg.' data with id: '.$id.' on index page by user: '.Auth::id());
        return back()->with('status', 'Url successfully '.$msg);
    }

}
