<?php
namespace PhpTranspiler\Framework\SourceElements;

use PhpParser\Node\Stmt\Class_;
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
        $this->name = $name;
        if ( ! in_array($accessLevel, array(
            Class_::MODIFIER_PUBLIC,
            Class_::MODIFIER_PROTECTED,
            Class_::MODIFIER_PRIVATE
        ), true)
        ) {
            throw new \InvalidArgumentException (
                'Invalid Access level, must be either PhpParser\Node\Stmt\Class_::MODIFIER_PUBLIC,PhpParser\Node\Stmt\Class_::MODIFIER_PROTECTED or PhpParser\Node\Stmt\Class_::MODIFIER_PRIVATE');
        }
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