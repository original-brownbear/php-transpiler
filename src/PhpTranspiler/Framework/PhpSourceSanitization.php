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
        $phpSection      = false;
        $sanitizedTokens = array();
        $openTagFound    = false;
        foreach ($tokens as $token) {
            if (($openTagNow = $token[0] === T_OPEN_TAG) === true) {
                $phpSection = true;
            } elseif ($token[0] === T_CLOSE_TAG) {
                $phpSection = false;
            }
            if ($phpSection && ! ($openTagFound && $openTagNow)) {
                $openTagFound      = true;
                $sanitizedTokens[] = $token;
            }
        }

        $output = '';
        foreach ($sanitizedTokens as $key => $token) {
            $output .= '' . (is_array($token) ? $token[1]
                    : (isset($sanitizedTokens[$key + 1]) && $token === ';'
                        ? $token . "\n" : $token)
                );
        }

        return $output;
    }
}