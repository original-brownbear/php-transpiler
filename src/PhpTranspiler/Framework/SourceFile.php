<?php
namespace PhpTranspiler\Framework;

use Symfony\Component\Console\Exception\InvalidArgumentException;

class SourceFile
{
    private $url;

    public function __construct($path)
    {
        if (false === is_file($path)) {
            throw new InvalidArgumentException('Given path does not contain a file.');
        }

        $this->url = $path;
    }

    public function isPhpFile()
    {
        $tokens = token_get_all(file_get_contents($this->url));
        foreach ($tokens as $token) {
            if ($token[0] === T_OPEN_TAG) {
                $found_opening_tag = true;
                break;
            }
        }

        return ! empty($found_opening_tag);
    }
}