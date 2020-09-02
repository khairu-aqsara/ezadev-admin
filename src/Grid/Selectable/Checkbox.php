<?php

namespace Ezadev\Admin\Grid\Selectable;

use Ezadev\Admin\Grid\Displayers\AbstractDisplayer;

class Checkbox extends AbstractDisplayer
{
    public function display($key = '')
    {
        $value = $this->getAttribute($key);

        return <<<EOT
<input type="checkbox" name="item" class="select" value="{$value}"/>
EOT;
    }
}
