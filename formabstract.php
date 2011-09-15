<?php

abstract class FormAbstract
{
    abstract function dispatch();

    public function getPostFields()
    {
        $result = '';
        if($this->fields) {
            foreach($this->fields as $field) {
                $result .= $field->toString();
            }
        }
        return $result;
    }
}