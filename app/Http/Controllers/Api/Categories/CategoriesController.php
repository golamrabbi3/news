<?php

namespace App\Http\Controllers\Api\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Categories\CategoryRequest;
use App\Http\Resources\Categories\CategoryCollection;
use App\Http\Resources\Categories\CategoryResource;
use App\Models\Category;
use App\Services\FileService;
use Exception;
use Illuminate\Http\UploadedFile;
use MediaPath;
use PaginatedNumber;
use Throwable;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = new CategoryCollection(
                Category::with(
                    'image',
                    'category',
                )
                    ->withCount('categories', 'news')
                    ->latest()
                    ->paginate(PaginatedNumber::Categories)
            );

            return response()->json([
                'message' => __('Fetched category list successfully.'),
                'data' => $data->response()->getData(true),
            ]);
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'message' => __('Failed to fetch category list.'),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            $category = Category::create($request->only('name', 'is_active', 'category_id'));

            if ($request->hasFile('image')) {
                $this->_uploadImage($request->file('image'), $category);
            }

            return response()->json([
                'message' => __('The category has been created successfully.'),
                'data' => new CategoryResource($category),
            ]);
        } catch (Throwable $e) {
            report($e);
        }

        return response()->json([
            'message' => __('Failed to create the category! Please try again.')
        ], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load(
            'image',
            'category',
            'categories',
        )->loadCount('news', 'categories');

        return response()->json([
            'message' => __('Fetched category successfully.'),
            'data' => new CategoryResource($category),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $message = __('Failed to update the category! Please try again.');
        try {
            if (!$category->update($request->only('name', 'is_active', 'category_id'))) {
                throw new Exception($message);
            }

            if ($request->hasFile('image')) {
                $this->_uploadImage($request->file('image'), $category);
            }

            return response()->json([
                'message' => __('The category has been updated successfully.'),
                'data' => new CategoryResource($category),
            ]);
        } catch (Throwable $e) {
            report($e);
        }

        return response()->json(['message' => $message], 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            if ($category->delete()) {
                return response()->json(['message' => __('The category has been deleted successfully.')]);
            }
        } catch (Throwable $e) {
            report($e);
        }

        return response()->json([
            'message' => __('Failed to delete the category! Please try again.')
        ], 400);
    }

    private function _uploadImage(UploadedFile $file, Category $category): bool
    {
        $path = FileService::upload(
            file: $file,
            path: MediaPath::Categories,
            fileName: 'category',
            suffix: $category->id,
            disk: 'public',
            imageWidth: 1024,
            imageHeight: 1024
        );

        if ($path) {
            $category->image()->updateOrCreate([
                'path' => $path
            ]);

            return true;
        }

        return false;
    }
}
