<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id  = auth('api')->user()->id;
        $contacts = Contact::getAllContacts($user_id);

        return $this->defaultResponse([
            'message' => 'success get all contacts',
            'data'    => $contacts,
            'status'  => Response::HTTP_OK,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ContactStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactStoreRequest $request)
    {
        $request->validated();

        $contact = Contact::create([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'user_id' => auth('api')->user()->id,
        ]);

        return $this->defaultResponse([
            'message' => 'new contact created successfully',
            'data'    => $contact->contactAttributes(),
            'status'  => Response::HTTP_CREATED,
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
        return $this->defaultResponse([
            'message' => 'contact found',
            'data'    => $contact->contactAttributes(),
            'status'  => Response::HTTP_OK
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ContactStoreRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactStoreRequest $request, Contact $contact)
    {
        $request->validated();

        $contact->update([
            'name'  => $request->name,
            'phone' => $request->phone,
        ]);

        return $this->defaultResponse([
            'message' => 'contact has been updated',
            'data'    => $contact->contactAttributes(),
            'status'  => Response::HTTP_OK,
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
            'status'  => Response::HTTP_OK,
        ]);
    }
}
