<?php

abstract class FieldAbstract
{
    protected $fieldName;
    protected $value;

    public function __construct($fieldName, $value)
    {
        $this->fieldName = $fieldName;
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function toArray()
    {
        return array($this->fieldName => $this->value);
    }

    public function toString()
    {
        return $this->fieldName . '=' . $this->value . '&';
    }
}