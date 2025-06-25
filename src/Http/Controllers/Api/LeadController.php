<?php

namespace Backstage\Crm\Http\Controllers\Api;

use Backstage\Crm\Models\Lead;
use Backstage\Crm\Resources\LeadResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LeadController extends Controller
{
    public function index()
    {
        return LeadResource::collection(Lead::all());
    }

    public function show(Lead $lead)
    {
        return new LeadResource($lead);
    }

    public function store(Request $request)
    {
        $lead = Lead::create($request->input());

        return new LeadResource($lead);
    }

    public function update(Request $request, Lead $lead)
    {
        $lead->update($request->input());

        return new LeadResource($lead);
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();

        return response()->noContent();
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $leads = Lead::where('first_name', 'like', "%{$query}%")
            ->orWhere('last_name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->get();

        return LeadResource::collection($leads);
    }
}
