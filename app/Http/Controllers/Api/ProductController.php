<?php
   
namespace App\Http\Controllers\Api;
   
use Illuminate\Http\Request;
use App\Http\Requests\Api\ProductStoreRequest;
use App\Http\Requests\Api\ProductUpdateRequest;
use App\Http\Controllers\Controller as Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;
use App\Traits\Api\HasSendResponse;
   
class ProductController extends Controller
{
	use HasSendResponse;
	
	public function __construct(
		protected Product $product
	) {}
	
    public function index(): JsonResponse {
        $products = $this->product->all();    
        return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully', 200);
    }

    public function store(ProductStoreRequest $request): JsonResponse {
		$product = $this->product->create($request->validated());   
        return $this->sendResponse(new ProductResource($product), 'Product created successfully', 201);
    } 
   
    public function show($id): JsonResponse {
        $product = $this->product->find($id);
  
        if (is_null($product)) {
            return $this->sendError('Product not found', [], 404);
        }
   
        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully', 200);
    }
    
    public function update(ProductUpdateRequest $request, Product $product): JsonResponse {
		$product->fill($request->validated())->save();
   
        return $this->sendResponse(new ProductResource($product), 'Product updated successfully', 200);
    }
   
    public function destroy(Product $product): JsonResponse {
        $product->delete();
   
        return $this->sendResponse([], 'Product deleted successfully', 200);
    }
}