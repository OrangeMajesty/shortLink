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

        
        $shortCode = $this->generate($request);

        $shortLink = route('redirectToFull', ['short' => $shortCode]);

    	return view('start')->with('message', $shortLink);

    }

    public function generate(Request $request)
    {
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

        return $short;
    }

    public function redirectToFull($short)
    {
        $request = Links::where('short', $short);
        $originalLink = $request->value('full');

        if(!empty($originalLink))
            return redirect($originalLink);

        return view('start')->with('message', "Link in not defined.");
    }
}
