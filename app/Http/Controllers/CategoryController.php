<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get()->toTree();
        return response()->xml(['category' => $categories->toArray()]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $xmlPayload = $request->getContent();
        $payload = simplexml_load_string($xmlPayload);

        # create a new category
        $category = new Category();
        $category->name = $payload->name;

        // check if there is no name
        if (!$payload->name) {
            return response()->xml(['error' => 'Name is required']);
        }

        // check if there is a parent_id
        if ($payload->parent_id) {
            $parent = Category::find($payload->parent_id);
            if ($parent) {
                $category->appendToNode($parent);
            } else {
                return response()->xml(['error' => 'No parent found']);
            }
        }
        $category->save();
        return response()->xml($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $category = Category::find($id);
        if ($category) {
            return response()->xml(['category' => $category->toArray()]);
        } else {
            return response()->xml(['error' => 'category not found']);
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->xml(['error' => 'category not found']);
        }
        $xmlPayload = $request->getContent();
        $payload = simplexml_load_string($xmlPayload);
        $category->name = $payload->name;

        // find a parent
        $parent = Category::find($payload->parent_id);
        try {
            if ($parent) {
                $category->appendToNode($parent);
            }
            $category->save();
        } catch (Exception $e) {
            return response()->xml(['error' => $e->getMessage()]);
        }
        return response()->xml($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->xml(['success' => 'category removed']);
        } else {
            return response()->xml(['error' => 'no category found']);
        }
    }
}
