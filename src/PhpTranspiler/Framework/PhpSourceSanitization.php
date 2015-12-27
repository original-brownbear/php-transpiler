<?php
namespace PhpTranspiler\Framework;

class PhpSourceSanitization
{
    private $source;

    public function __construct($source)
    {
        $this->source = $source;
    }

    public function stringContent()
    {
        $tokens          = token_get_all($this->source);
        $sanitizedTokens = array();
        foreach ($tokens as $index => $token) {
            if (isset($token[1])) {
                $token[1] = str_replace("\n", ' ', $token[1]);
                $token[1] = str_replace("\t", ' ', $token[1]);
                if (isset($tokens[$index - 1]) && in_array($tokens[$index - 1],
                        array('{', ';'), true)
                ) {
                    $token[1] = str_replace(' ', '', $token[1]);
                }
                if (isset($tokens[$index + 1]) && in_array($tokens[$index + 1],
                        array('{', ';', '}'), true)
                ) {
                    $token[1] = str_replace(' ', '', $token[1]);
                }
            }
            $sanitizedTokens[] = $token;
        }
        $output = '';
        foreach ($sanitizedTokens as $key => $token) {
            $output .= '' . (is_array($token) ? $token[1] : $token);
        }

        return $output;
    }
}