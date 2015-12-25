<?php
namespace PhpTranspiler\Framework;

class SourceFile extends SourceLocation
{
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

    protected function invalidPathMessage()
    {
        return 'Given path does not contain a file.';
    }

    protected function checkValidPath()
    {

        return is_file($this->url);
    }
}