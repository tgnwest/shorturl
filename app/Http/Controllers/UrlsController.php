<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;

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
        $this->url->store($request);
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
        return back()->with('status', 'Url successfully '.$msg);
    }

    public static function redirect()
    {
        dd('sdfsdf');
    }

}
