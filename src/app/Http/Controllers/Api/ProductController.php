<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @throws ValidationException
     */
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $currency = $request->input('currency', 'RUB');

        $request->merge(['currency' => strtoupper($currency)]);

        if (! in_array($request->input('currency'), ['RUB', 'USD', 'EUR'])) {
            throw ValidationException::withMessages([
                'currency' => 'Invalid currency',
            ]);
        }

        $products = Product::all();

        return ProductResource::collection($products);
    }
}
