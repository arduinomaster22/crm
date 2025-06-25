<?php

namespace Backstage\Crm\Http\Controllers\Api;

use Backstage\Crm\Models\Organization;
use Backstage\Crm\Resources\OrganizationResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OrganizationController extends Controller
{
    public function index()
    {
        return OrganizationResource::collection(Organization::all());
    }

    public function show(Organization $organization)
    {
        return new OrganizationResource($organization);
    }

    public function store(Request $request)
    {
        $organization = Organization::create($request->input());

        return new OrganizationResource($organization);
    }

    public function update(Request $request, Organization $organization)
    {
        $organization->update($request->input());

        return new OrganizationResource($organization);
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();

        return response()->noContent();
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $organizations = Organization::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->get();

        return OrganizationResource::collection($organizations);
    }
}
