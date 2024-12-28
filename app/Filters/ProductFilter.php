<?php

namespace App\Filters;

class ProductFilter extends Filter
{
    /**
     * Define the allowed filter keys.
     *
     * @return array
     */
    protected function filterKeys(): array
    {
        return ['name', 'min_quantity', 'max_quantity', 'min_price', 'max_price', 'sort_by', 'sort_order'];
    }

    /**
     * Filter by name.
     *
     * @param string $name
     * @return void
     */
    protected function name(string $name): void
    {
        $this->builder->where('name', 'like', "%{$name}%");
    }

    /**
     * Filter by minimum quantity.
     *
     * @param int $quantity
     * @return void
     */
    protected function min_quantity(int $quantity): void
    {
        $this->builder->where('quantity', '>=', $quantity);
    }

    /**
     * Filter by maximum quantity.
     *
     * @param int $quantity
     * @return void
     */
    protected function max_quantity(int $quantity): void
    {
        $this->builder->where('quantity', '<=', $quantity);
    }

    /**
     * Filter by minimum price.
     *
     * @param float $price
     * @return void
     */
    protected function min_price(float $price): void
    {
        $this->builder->where('price', '>=', $price);
    }

    /**
     * Filter by maximum price.
     *
     * @param float $price
     * @return void
     */
    protected function max_price(float $price): void
    {
        $this->builder->where('price', '<=', $price);
    }

    /**
     * Sort the results.
     *
     * @param string $sortBy
     * @return void
     */
    protected function sort_by(string $sortBy): void
    {
        $sortOrder = $this->request->get('sort_order', 'asc');
        $this->builder->orderBy($sortBy, $sortOrder);
    }
}

