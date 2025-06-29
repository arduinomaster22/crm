<?php

namespace Backstage\Crm\Http\Controllers\Api;

use Backstage\Crm\Models\Tag;
use Backstage\Crm\Resources\TagResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TagController extends Controller
{
    public function index()
    {
        return TagResource::collection(Tag::all());
    }

    public function store(Request $request)
    {
        $tagsTable = app(Tag::class)->getTable();

        $data = $request->validate([
            'name' => 'required|string|unique:' . $tagsTable . ',name',
            'color' => 'nullable|string',
        ]);

        $tag = Tag::query()
            ->create($data);

        return new TagResource($tag);
    }

    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    public function update(Request $request, Tag $tag)
    {
        $tagsTable = app(Tag::class)->getTable();

        $data = $request->validate([
            'name' => 'required|string|unique:' . $tagsTable . ',name,' . $tag->id,
            'color' => 'nullable|string',
        ]);

        $tag->update($data);

        return new TagResource($tag);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $tags = Tag::query()
            ->where('name', 'like', "%{$query}%")
            ->get();

        return TagResource::collection($tags);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response()->noContent();
    }
}
