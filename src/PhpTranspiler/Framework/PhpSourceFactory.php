<?php
namespace PhpTranspiler\Framework;

use Symfony\Component\Console\Exception\InvalidArgumentException;

class PhpSourceFactory
{
    public function isValid($source)
    {
        $tokens = token_get_all($source);
        foreach ($tokens as $token) {
            if ($token[0] === T_OPEN_TAG) {
                $foundOpeningTag = true;
                break;
            }
        }

        return ! empty($foundOpeningTag);
    }

    /**
     * @param SourceFile $sourceFile
     *
     * @return PhpSource
     */
    public function phpSource($sourceFile)
    {
        $content = $sourceFile->stringContent();
        if ( ! $this->isValid($content)) {
            throw new InvalidArgumentException('Tried to generate source object from invalid PHP source.');
        }

        return new PhpSource($content);
    }
}