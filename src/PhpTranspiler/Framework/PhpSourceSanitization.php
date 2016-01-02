<?php
namespace PhpTranspiler\Framework;

use PhpParser\Parser;

class PhpSourceSanitization
{
    /** @var  string $source */
    private $source;

    /** @var Parser $parser */
    private $parser;

    public function __construct($parser, $source)
    {
        $this->parser = $parser;
        $this->source = $source;
    }

    public function stringContent()
    {
        $this->stripWhiteSpaces();

        return $this->source;
    }

    public function asNodes()
    {

        return $this->parser->parse($this->stringContent());
    }

    private function stripWhiteSpaces()
    {
        $hasOpeningTag   = strpos($this->source, '<?php') === false;
        $tokens          = token_get_all(($hasOpeningTag ? '<?php ' : '') . $this->source);
        $sanitizedTokens = array();
        foreach ($tokens as $index => $token) {
            if (isset($token[1]) && in_array($token[0],
                    array(T_WHITESPACE, T_LINE, T_OPEN_TAG, T_INLINE_HTML))
            ) {
                $token[1] = str_replace("\n", ' ', $token[1]);
                $token[1] = str_replace("\t", ' ', $token[1]);
                $token[1] = preg_replace('#\s+#', ' ', $token[1]);
                if (isset($tokens[$index - 1]) && in_array($tokens[$index - 1],
                        array('{', ';', '}'), true)
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
            $output .= (is_array($token) ? $token[1] : $token);
        }

        $this->source = $hasOpeningTag ? substr($output, 6) : $output;
    }
}