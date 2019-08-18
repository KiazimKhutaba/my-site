<?php


namespace Castels\Core;


abstract class Validator
{
    protected $errors = [];
    protected $model;

    /**
     * @return array
     */
    abstract function validate(): array;

    public function setModel(BaseModel $model)
    {
        $this->model = $model;
    }

    protected function addError($error)
    {
        $this->errors[] = $error;
    }
}