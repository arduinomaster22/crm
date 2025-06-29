<?php

namespace Backstage\Crm\Http\Controllers\Api;

use Backstage\Crm\Models\Contact;
use Backstage\Crm\Models\ContactMoment;
use Backstage\Crm\Resources\ContactMomentResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;

class ContactMomentController extends Controller
{
    public function index()
    {
        return ContactMomentResource::collection(ContactMoment::with('contacts')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'contactable_type' => ['required', 'string'],
            'contactable_id' => ['required', 'integer'],
            'subject' => ['required', 'string'],
            'body' => ['nullable', 'string'],
            'contact_date' => ['required', 'date'],
        ]);

        $moment = ContactMoment::create($data);

        return new ContactMomentResource($moment->load('contacts'));
    }

    public function show(ContactMoment $contactMoment)
    {
        return new ContactMomentResource($contactMoment->load('contacts'));
    }

    public function update(Request $request, ContactMoment $contactMoment)
    {
        $data = $request->validate([
            'contactable_type' => ['nullable', 'string'],
            'contactable_id' => ['nullable', 'integer'],
            'subject' => ['nullable', 'string'],
            'body' => ['nullable', 'string'],
            'contact_date' => ['nullable', 'date'],
        ]);

        $contactMoment->update($data);

        return new ContactMomentResource($contactMoment->fresh('contacts'));
    }

    public function destroy(ContactMoment $contactMoment)
    {
        $contactMoment->delete();

        return response()->noContent();
    }

    public function attachContacts(Request $request, ContactMoment $contactMoment)
    {
        $data = $request->validate([
            'contacts' => ['required', 'array'],
        ]);

        $contactMoment->contacts()->syncWithoutDetaching($data['contacts']);

        return new ContactMomentResource($contactMoment->fresh('contacts'));
    }

    public function detachContacts(Request $request, ContactMoment $contactMoment)
    {
        $data = $request->validate([
            'contacts' => ['required', 'array'],
            'contacts.*' => ['required', 'integer', Rule::exists((new Contact)->getTable(), 'id')],
        ]);

        $contactMoment->contacts()->detach($data['contacts']);

        return new ContactMomentResource($contactMoment->fresh('contacts'));
    }
}
