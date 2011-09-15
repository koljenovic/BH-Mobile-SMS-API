<?php

require_once 'fieldabstract.php';

class Field extends FieldAbstract
{
    public function __constructor($fieldName, $value = '')
    {
        parent::__construct($fieldName, $value);
    }
}
