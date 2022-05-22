<?php

namespace App\Http\Controllers;

use App\Models\Offers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offers = Offers::orderBy('created_at', 'DESC') -> get();

        /*
            Filter offers by type (INTEGER).
            'type' key must be included in the request body.
        */

        if($request->has('type')){
            $offers = $offers->filter(function ($offer) use ($request){
                return $offer->type === $request->type;
            })->values();;
        }

        /*
            Filter offers by compay (STRING).
            'company' key must be included in the request body.
        */

        if($request->has('company')){
            $offers = $offers->filter(function ($offer) use ($request){
                return $offer->company === $request->company;
            })->values();;
        }

        /*
            Filter offers by keywords (ARRAY OF STRING).
            'keywords' key must be included in the request body.
            Case doesn't matter here, everything is converted to lowercase.
        */

        if($request->has('keywords')){
            foreach ($request->keywords as $keyword) {
                $offers = $offers->filter(function ($offer) use ($keyword){
                    $normalizedKeyword = $this->convertStringToNormal($keyword);
                    return str_contains($this->convertStringToNormal($offer->title), $normalizedKeyword) || str_contains($this->convertStringToNormal($offer->description), $normalizedKeyword) || str_contains($this->convertStringToNormal($offer->company), $normalizedKeyword);
                })->values();
            }
        }

        /*
            Limit numbers of returned offers (INTEGER).
            'limit' key must be included in the request body.
        */

        if($request->has('limit')){
            $offers = $offers->take($request->limit);
        }

        return $offers;
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
        $newOffer = new Offers;
        $newOffer -> title = $request -> offer['title'];
        $newOffer -> company = $request -> offer['company'];
        $newOffer -> type = $request -> offer['type'];
        $newOffer -> location = $request -> offer['location'];
        $newOffer -> salary = $request -> offer['salary'];
        $newOffer -> description = $request -> offer['description'];
        $newOffer -> save();

        return $newOffer;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Offers::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $offer = Offers::findOrFail($id);
        $offer -> update($request->offer);

        return $offer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Offers::find($id)->delete();
    }

    function convertStringToNormal($string){
        return strtolower(STR::ascii($string));
    }
}
