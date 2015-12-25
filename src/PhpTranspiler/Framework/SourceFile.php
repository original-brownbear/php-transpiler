<?php
namespace PhpTranspiler\Framework;

class SourceFile extends SourceLocation
{
    public function isPhpFile()
    {
        $tokens = token_get_all(stream_get_contents($this->getHandle()));
        foreach ($tokens as $token) {
            if ($token[0] === T_OPEN_TAG) {
                $foundOpeningTag = true;
                break;
            }
        }

        return ! empty($foundOpeningTag);
    }

    protected function invalidPathMessage()
    {
        return 'Given path does not contain a file.';
    }

    protected function checkValidPath()
    {

        return is_file($this->url);
    }

    protected function getHandle()
    {
        return fopen($this->url, 'r');
    }
}