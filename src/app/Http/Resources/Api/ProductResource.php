<?php

declare(strict_types=1);

namespace app\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'price' => $this->resource->price,
            'price_formatted' => static::formatPrice($this->resource->price, $request->input('currency', 'RUB')),
        ];
    }

    protected static function formatPrice(float $price, string $currency): string
    {
        $convertedPrice = match ($currency) {
            'USD' => $price / 90,
            'EUR' => $price / 100,
            default => $price,
        };

        return match ($currency) {
            'USD' => '$'.number_format($convertedPrice, 2, '.', ''),
            'EUR' => '€'.number_format($convertedPrice, 2, '.', ''),
            default => number_format($convertedPrice, 2, '.', ' ').' ₽',
        };
    }
}
