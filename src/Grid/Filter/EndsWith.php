<?php

namespace Ezadev\Admin\Grid\Filter;

class EndsWith extends Like
{
    protected $exprFormat = '%{value}';
}
