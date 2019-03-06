<?php namespace App\Services;

use App\Models\AttributeStickers;
use App\Models\ProductAttribute;
use App\Models\ProductVariation;
use App\Models\PromotionPrice;
use App\Models\Stock;
use App\Models\StockAttribute;
use App\Models\StockTypeAttribute;
use App\Models\StockVariation;
use App\Models\StockVariationOption;

/**
 * Created by PhpStorm.
 * User: edo
 * Date: 10/18/2018
 * Time: 1:01 PM
 */
class StockService
{
    public function makeOptions($stock, array $data = [])
    {
        $result = [];

        if (count($data)) {
            foreach ($data as $parent_id => $ids) {
                $parent = StockAttribute::where('stock_id', $stock->id)
                    ->where('attributes_id', $parent_id)->where('parent_id', null)->first();

                if ($parent && count($ids)) {
                    foreach ($ids as $id) {
                        if ($id) {
                            $result[] = ['parent_id' => $parent->id, 'sticker_id' => $id, 'attributes_id' => $parent_id];
                        }
                    }
                }
            }
        }

        return $result;
    }

    public function makeTypeOptions($stock, array $data = [])
    {
        $result = [];
        $stock->type_attrs_all()->delete();
        if (count($data)) {
            foreach ($data as $datum) {
                if (isset($datum['attributes_id']) && isset($datum['type']) && isset($datum['options'])) {
                    $attr_id = $datum['attributes_id'];
                    $type = $datum['type'];
                    $ids = $datum['options'];
                    $result[] = ['attributes_id' => $attr_id, 'type' => $type, 'sticker_id' => null];
                    if (count($ids)) {
                        foreach ($ids as $id) {
                            if ($id) {
                                $result[] = ['attributes_id' => $attr_id, 'sticker_id' => $id];
                            }
                        }
                    }
                }
            }
        }

        $stock->type_attrs()->sync($result);
        return $result;
    }

    public function saveSpecifications($stock, array $data = [])
    {
        $result = [];
        $stock->stockAttrs()->delete();
        if (count($data)) {
            foreach ($data as $datum) {
                if (isset($datum['attributes_id'])) {
                    $parent = (new StockAttribute())->create([
                        'stock_id' => $stock->id,
                        'attributes_id' => $datum['attributes_id']
                    ]);

                    if (isset($datum['options']) && count($datum['options'])) {
                        foreach ($datum['options'] as $sticker) {
                            (new StockAttribute())->create([
                                'stock_id' => $stock->id,
                                'attributes_id' => $datum['attributes_id'],
                                'sticker_id' => $sticker,
                                'parent_id' => $parent->id,
                            ]);
                        }
                    }
                }
            }
        }

        return true;
    }

    public function makeProductOptions($product, array $data = [])
    {
        $result = [];
        if (count($data)) {
            foreach ($data as $parent_id => $ids) {
                $parent = ProductAttribute::where('product_id', $product->id)
                    ->where('attributes_id', $parent_id)->where('parent_id', null)->first();
                $ids = explode(',', $ids);
                if (count($ids)) {
                    foreach ($ids as $id) {
                        if ($id) {
                            $result[$id] = ['parent_id' => $parent->id];
                        }
                    }
                }

            }
        }

        return $result;
    }

    public function saveVariations($stock, array $data = [])
    {
//        $stock->variations()->delete();

        if (count($data)) {
            $deletableArray = [];
            foreach ($data as $variation_id => $data) {
                $newData = $data;
                $newData['stock_id'] = $stock->id;
                $attributes = $newData['options'];
                unset($newData['options']);
//                dd($newData,$attributes);
                if (isset($newData['id'])) {
                    $variation = StockVariation::find($newData['id']);
                    $variation->update($newData);
                } else {
                    $variation = StockVariation::create($newData);
                }
                $deletableArray[] = $variation->id;
                $variation->options()->delete();
                if (isset($attributes) && count($attributes)) {
                    foreach ($attributes as $option) {
                        $as = AttributeStickers::where('attributes_id', $option['attributes_id'])->where('sticker_id', $option['options_id'])->first();
                        if ($as) {
                            $variation->options()->create(['attribute_sticker_id' => $as->id]);
                        }
                    }
                }
            }

            $stock->variations()->whereNotIn('id', $deletableArray)->delete();
        }
    }

    public function savePackageVariation($stock, array $data = [], $price)
    {
        if (count($data)) {
            $deletableArray = [];
            foreach ($data as $variation_id => $data) {
                $newData = $data;
                $newData['stock_id'] = $stock->id;
                $newData['price'] = $price;

                if (isset($newData['id'])) {
                    $variation = StockVariation::find($newData['id']);
                    $variation->update($newData);
                } else {
                    $variation = StockVariation::create($newData);
                }
                $deletableArray[] = $variation->id;
            }

            $stock->variations()->whereNotIn('id', $deletableArray)->delete();
        }
    }

    public function savePromotionPrices($promotion, array $data = [])
    {
        if (count($data)) {
            $deletableArray = [];
            foreach ($data as $promotion_id => $jsonData) {
                $newData = json_decode($jsonData, true);
                if ($promotion && $newData && count($newData)) {
                    foreach ($newData as $variation_id => $price) {
                        $promotionPrice = $promotion->promotion_prices()->where('variation_id', $variation_id)->first();
                        if ($promotionPrice) {
                            $promotionPrice->update(['price' => $price]);
                        } else {
                            $promotionPrice = $promotion->promotion_prices()->create(['variation_id' => $variation_id, 'price' => $price]);
                        }
                        $deletableArray[] = $promotionPrice->id;
                    }
                }
            }

            $promotion->promotion_prices()->whereNotIn('id', $deletableArray)->delete();
        }
    }

    public function saveSingleVariation($stock, array $data = [])
    {
        if (count($data)) {
            $data['stock_id'] = $stock->id;
            if (isset($data['id'])) {
                $variation = StockVariation::find($data['id']);
                $variation->update($data);
            } else {
                $variation = StockVariation::create($data);
            }

            $stock->variations()->where('id', '!=', $variation->id)->delete();
        }
    }

    public function saveProductVariations($product, array $data = [], array $options = [])
    {
        $product->variations()->delete();
        if (count($data)) {
            foreach ($data as $variation_id => $data) {
                $newData = json_decode($data, true);
                unset($newData['_token']);
                if (isset($newData['stock_id'])) {
                    unset($newData['stock_id']);
                }

                $newData['product_id'] = $product->id;
                $variation = ProductVariation::create($newData);
                if (isset($options[$variation_id]) && count($options[$variation_id])) {
                    foreach ($options[$variation_id] as $option) {
                        $variation->options()->create($option);
                    }
                }
            }
        }
    }
}