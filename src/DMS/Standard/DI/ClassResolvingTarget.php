<?php

namespace DMS\Standard\DI;

class ClassResolvingTarget
{
    /**
     * @var string
     */
    protected $targetClass;

    /**
     * @param $classname
     */
    public function injectTargetClassName($classname)
    {
        $this->targetClass = $classname;
    }

    /**
     * @return string
     */
    public function getTargetName()
    {
        if ($this->targetClass === null) {
            throw new \UnexpectedValueException("Target Class was not injected");
        }

        return $this->targetClass;
    }
}
