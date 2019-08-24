<?php

namespace Ezadev\Admin\Grid\Filter;

class NotIn extends In
{
    /**
     * {@inheritdoc}
     */
    protected $query = 'whereNotIn';
}
