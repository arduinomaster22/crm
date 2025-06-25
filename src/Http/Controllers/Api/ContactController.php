<?php

namespace Backstage\Crm\Http\Controllers\Api;

use Backstage\Crm\Models\Contact;
use Backstage\Crm\Resources\ContactResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ContactController extends Controller
{
    public function index()
    {
        return ContactResource::collection(Contact::all());
    }

    public function show(Contact $contact)
    {
        return new ContactResource($contact);
    }

    public function store(Request $request)
    {
        $contact = Contact::create($request->input());

        return new ContactResource($contact);
    }

    public function update(Request $request, Contact $contact)
    {
        $contact->update($request->input());

        return new ContactResource($contact);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->noContent();
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $contacts = Contact::where('first_name', 'like', "%{$query}%")
            ->orWhere('last_name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->get();

        return ContactResource::collection($contacts);
    }
}
