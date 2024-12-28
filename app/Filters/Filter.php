<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter
{
    protected Request $request;
    protected Builder $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply filters to the query.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->filters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                call_user_func_array([$this, $filter], array_filter([$value]));
            }
        }

        return $this->builder;
    }

    /**
     * Get the filters from the request.
     *
     * @return array
     */
    protected function filters(): array
    {
        return $this->request->only($this->filterKeys());
    }

    /**
     * Define the keys for allowed filters.
     *
     * @return array
     */
    abstract protected function filterKeys(): array;
}

