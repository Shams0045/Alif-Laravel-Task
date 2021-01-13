<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator; 
use DB; 
use Input; 

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $contacts = Contact::where([
          ['name', '!=', Null],
          [function ($query) use ($request) {
              if (( $term = $request->term )) {
                  $query->orWhere('name', 'LIKE', '%' .$term. '%')->get();
              }
          }]
      ])
          ->orderBy('id')
          ->paginate(5);


        return view('contacts.index', compact('contacts'))
                ->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $contacts = new Contact();

        $contacts->name = request('name');
        $contacts->number = request('number');
        $contacts->email = request('email');
        
      
        $validatedData = $request->validate([
            'name' => 'required|unique:list',
            'number.*' => 'required|unique:list,number',
            'email.*' => 'required|unique:list,email'
        ]);
        
        $contacts->save(); 

        return redirect()->route('contacts.index')
                        ->with('success','Contact created successfully.');     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return view('contacts.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    { 

      $contacts = Contact::find($request->id);

      $contacts->name = request('name');
      $contacts->number = request('number');
      $contacts->email = request('email'); 

      $contacts->save();  
  
        return redirect()->route('contacts.index')
                        ->with('success','Contact updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
  
        return redirect()->route('contacts.index')
                        ->with('success','Contact deleted successfully');
    } 
}
