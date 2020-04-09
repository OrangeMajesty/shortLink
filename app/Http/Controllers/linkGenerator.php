<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

use App\Links;

class linkGenerator extends Controller
{
    public function index(Request $request)
    {

        $this->validate($request, [
            'full' => 'required'
        ]);

        $full = $request->get('full');

        $repeatedShort = Links::where('full', $full)->value('short');
        $short = Str::random(32);

        if(!empty($repeatedShort))
        {
            $short = $repeatedShort;
        } 
        else 
        {
            $link = new Links;
            $link->fill($request->all());
            $link->setShortLink($short);
            $link->save();
        }

    	$shortLink = route('redirectToFull', ['short' => $short]);

    	return view('start')->with('shortLinks', $shortLink);

    }

    public function show($short)
    {

    	$originalLink = Links::where('short', $short)->value('full');

        return redirect($originalLink);
    }
}
