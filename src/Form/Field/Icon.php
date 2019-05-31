<?php

namespace Ezadev\Admin\Form\Field;

class Icon extends Text
{
    protected $default = 'fa-pencil';

    protected static $css = [
        '/vendor/ezadev-admin/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css',
    ];

    protected static $js = [
        '/vendor/ezadev-admin/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.min.js',
    ];

    public function render()
    {
        $this->script = <<<EOT

$('{$this->getElementClassSelector()}').iconpicker({placement:'bottomLeft'});

EOT;

        $this->prepend('<i class="fa fa-pencil fa-fw"></i>')
            ->defaultAttribute('style', 'width: 140px');

        return parent::render();
    }
}
