<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavouriteRequest;
use App\Http\Resources\FavouriteResource;
use App\Models\Favourite;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function index()
    {
        $favourite = Favourite::all();

        return inertia('Home', [
            'favourites' => FavouriteResource::collection($favourite)
        ]);
    }

    public function create(FavouriteRequest $request)
    {
        //validating incoming request with the Request Class(FavouriteRequest)

        $favourite = new Favourite;
        $favourite->name = $request->name;
        $favourite->save();

        return redirect('/');
    }

    public function update(FavouriteRequest $request, Favourite $favourite)
    {
        //validating incoming request with the Request Class(FavouriteRequest)

        $favourite->name = $request->name;
        $favourite->update();

        return redirect('/');
    }

    public function destroy(Favourite $favourite)
    {
        $favourite->delete();

        return redirect('/');
    }
}
