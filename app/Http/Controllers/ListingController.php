<?php

namespace App\Http\Controllers;
use App\Models\listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;

class ListingController extends Controller
{

    //Show all listing
    public function index()
    {
        return view('listings.index', [
            //filter by clicking on tags
            'listings' => Listing::latest()->filter
            (request(['tag', 'search']))->paginate(6)
            //::all() shows in random order
        ]);

        //
    }

    //Show single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);

    }

    // Show Create Form
    public function create()
    {
        return view('listings.create');
    }

    //Store Listings data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => [
                'required',
                Rule::unique(
                    'listing',
                    'company'
                )
            ],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        //file upload
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        //listing of particular user
        $formFields['user_id'] = auth::id();


        listing::create($formFields);

        //for flash messages
        //method one
        // Session::flash('message', 'Listing Created');


        //method two
        return redirect('/')->with('message', 'Listing Created Successfully');
    }

    // Show EDIT FORM
    public function edit(Listing $listing)
    {
        return view('listings.edit', [
            'listing' => $listing
        ]);
    }


    //Update Listings data
    public function update(Request $request, Listing $listing)
    {

        //Logged in user is owner
        if ($listing->user_id != auth::id()) {
            abort(403, "Unauthorized Action");
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        //file upload
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }


        $listing->update($formFields);

        return back()->with('message', 'Listing Updated Successfully');
    }

    //Delete Listing
    public function destroy(Listing $listing)
    {

        //Logged in user is owner
        if ($listing->user_id != auth::id()) {
            abort(403, "Unauthorized Action");
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    //Manage Listing
    public function manage()
    {
        return view('listings.manage', [
            'listings' => Auth::user()->listings
        ]);
    }

}
