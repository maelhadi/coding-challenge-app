<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FileUploadService;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    private $productService;
    private $fileUploadService;

    public function __construct(ProductService $productService, FileUploadService $fileUploadService)
    {
        $this->productService = $productService;
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): Response
    {
        $products = $this->productService->getProducts($request->all());

        return response($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): Response
    {
        $product = $this->productService->createProduct($request->all());

        return response($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): Response
    {
        if ($this->productService->destroyProduct($id)) {
            return response(null, 204);
        } else {
            return response(['error' => 'An error occured while deleting'], 500);
        }
    }

    public function upload(Request $request): Response
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        } catch (Exception $e) {
            return response(['error' => $e->getMessage()]);
        }

        $image = $request->file('image');
        $url = $this->fileUploadService->uploadFile($image);

        return response(['url' => $url]);
    }
}
