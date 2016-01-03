<?php

namespace PhpTranspiler\Framework\FileChecks;

use PhpParser\Node\Expr\Include_;
use PhpTranspiler\Framework\SourceFile;
use PhpParser\PrettyPrinter;
use PhpTranspiler\Framework\SourceWriter;

class RequireCheck
{
    use SourceWriter;

    /** @var  SourceFile $sourceFile */
    private $sourceFile;

    public function __construct($sourceFile)
    {
        $this->sourceFile = $sourceFile;
    }

    /**
     * @return SourceFile[]
     */
    public function requireUses()
    {
        $tokens     = $this->sourceFile->sourceTree();
        $hasRequire = array();
        foreach ($tokens as $key => $node) {
            /** @var $node Include_ */
            if ($node->getType() === 'Expr_Include' && in_array($node->type,
                    array(Include_::TYPE_REQUIRE, Include_::TYPE_INCLUDE))
                && $node->expr->getType() === 'Scalar_String'
            ) {
                $hasRequire[$key] = $this->sourceFile->relativeFile($node->expr->{'value'});
            }
        }

        return $hasRequire;
    }

    public function fix()
    {
        $tokens    = $this->sourceFile->sourceTree();
        $fixes     = $this->requireUses();
        $positions = array_keys($fixes);
        $slices    = array();
        $offset    = 0;
        if ((bool)$fixes === true) {
            while ((bool)$positions) {
                $length   = array_shift($positions) - $offset;
                $slices[] = array_slice($tokens, $offset, $length);
                $slices[] = array_slice($tokens, $offset + 1 + $length);
                $offset += $length;
            }
            $res = array();
            while ($fixes) {
                $res = array_merge($res, array_shift($slices));
                $res = array_merge($res, array_shift($fixes)->sourceTree());
                $res = array_merge($res, array_shift($slices));
            }
            $this->sourceFile->setStringContent($this->nodesToSource($res));
        }

        return $this->sourceFile;
    }
}