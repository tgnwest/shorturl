<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class Url extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'origin', 'short', 'count'];

    /**
     * Get the user that owns the url.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Validate new short url form data
     *
     * @param array $data
     * @return mixed
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'origin' => 'required|active_url|string|max:255',
            'short' => 'max:50|unique:urls',
        ]);
    }

    /**
     * Check title of short link to unique
     *
     * @param $link
     * @return bool
     */
    protected function checkShortLinkUnique($link)
    {
        return $this->where('short', $link)->first() ? true : false;
    }

    /**
     * Generate short link
     *
     * @return string
     */
    protected function generateShortLink()
    {
        $shortLink = str_random('10');
        while ($this->checkShortLinkUnique($shortLink)) {
            $shortLink = str_random('10');
        }
        return $shortLink;
    }

    /**
     * Store new record in db
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->validator($request->all())->validate();
        if (!$request->short) {
            $data['short'] = $this->generateShortLink();
        }

        return $this->create($data);
    }

    /**
     * Get all auth user links
     *
     * @return mixed
     */
    public function getAllUserLinks()
    {
        return $this->where('user_id', Auth::id())->get();
    }

    /**
     * Get all links
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllLinks()
    {
        return $this->with('user')->where('isShared', 1)->get();
    }

    /**
     * Get url by id
     *
     * @param $id
     * @return mixed
     */
    public function getUrlById($id)
    {
        return $this->find($id);
    }

    /**
     * Delete record from db
     *
     * @param $id
     * @return string
     */
    public function deleteUrl($id)
    {
        $this->find($id)->delete();
        return '';
    }

    /**
     * Share or hide link
     *
     * @param $id
     * @return string
     */
    public function shareUrl($id)
    {
        $url = $this->find($id);
        if ($url->isShared) {
            $url->isShared = 0;
            $url->save();
            return 'hidden';
        } else {
            $url->isShared = 1;
            $url->save();
            return 'shared';
        }
    }

    public static function redirect(Request $request)
    {
        $short = substr(parse_url($request->url())['path'], 1);
        $url = Url::where('short', $short)->first();
        if (!$url)
            return false;
        else
            return $url;
    }

}
