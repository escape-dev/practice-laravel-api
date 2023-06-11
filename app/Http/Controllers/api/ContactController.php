<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = new Contact();

        return $this->defaultResponse([
            'message' => 'success get all contacts',
            'data'    => $contacts->getAllContacts(),
            'status'  => 200,
        ]);
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
         $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'phone'    => 'required',
        ]);

        if ($validator->fails()) {
            return $this->defaultResponse([
                'message' => $validator->errors(),
                'data'    => null,
                'status'  => 422,
            ]);
        }

        $contact = Contact::create([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return $this->defaultResponse([
            'message' => 'new contact created successfully',
            'data'    => $contact->contactAttributes(),
            'status'  => 201,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
         $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'phone'    => 'required',
        ]);

        if ($validator->fails()) {
            return $this->defaultResponse([
                'message' => $validator->errors(),
                'data'    => null,
                'status'  => 422,
            ]);
        }

        $contact->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return $this->defaultResponse([
            'message' => 'contact has been updated',
            'data'    => $contact->contactAttributes(),
            'status'  => 200,
        ]);
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

        return $this->defaultResponse([
            'message' => 'contact has been deleted',
            'data'    => $contact->contactAttributes(),
            'status'  => 200,
        ]);
    }
}
