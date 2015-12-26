<?php
namespace PhpTranspiler\Framework\SourceElements;

use PhpTranspiler\Framework\Base\NamedElement;

class PhpClassProperty implements NamedElement
{
    private $name;
    private $accessLevel;

    /**
     * PhpClassProperty constructor.
     *
     * @param string $name
     * @param int    $accessLevel
     */
    public function __construct($name, $accessLevel)
    {
        $this->name        = $name;
        $this->accessLevel = $accessLevel;
    }

    public function name()
    {

        return $this->name;
    }

    public function accessLevel()
    {

        return $this->accessLevel;
    }
}