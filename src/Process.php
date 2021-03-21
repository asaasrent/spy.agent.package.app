<?php


namespace SpyAgent;


abstract class Process
{
    public $attributes;

    abstract function getAcceptanceCriteria(): array;

    abstract static function getInstance();

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setAttributes($attributes): void
    {
        $this->attributes = $attributes;
    }


}
