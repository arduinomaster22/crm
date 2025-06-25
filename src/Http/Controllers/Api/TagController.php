<?php

namespace Backstage\Crm\Http\Controllers\Api;

use Illuminate\Http\Request;
use Backstage\Crm\Models\Tag;
use Illuminate\Routing\Controller;
use Backstage\Crm\Resources\TagResource;

class TagController extends Controller
{
    public function index()
    {
        return TagResource::collection(Tag::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:crm_tags,name',
            'color' => 'nullable|string',
        ]);

        $tag = Tag::create($data);

        return new TagResource($tag);
    }

    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:crm_tags,name,' . $tag->id,
            'color' => 'nullable|string',
        ]);

        $tag->update($data);

        return new TagResource($tag);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $tags = Tag::where('name', 'like', "%{$query}%")->get();

        return TagResource::collection($tags);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response()->noContent();
    }
}
