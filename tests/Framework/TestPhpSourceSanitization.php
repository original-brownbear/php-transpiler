<?php
use \PhpTranspiler\Framework\PhpSourceSanitization;

class PhpSourceSanitizationTest extends PhpTranspilerTestCase
{
    public function testStringContent()
    {
        foreach (array("echo 'bar'", 'return "x\n"') as $keep) {
            foreach (array("", " ", "\t") as $issueSpace) {
                foreach (array(" ", "\t") as $whiteSpace) {
                    $php                 = $keep . $issueSpace . ';';
                    $phpSanitized        = $keep . ';';
                    $sourceCode          = "<?php\n" . $php;
                    $sourceCodeSanitized = '<?php ' . $phpSanitized;
                    $parser              = $this->sourceFactory()->parser();
                    $this->assertEquals($sourceCodeSanitized,
                        (new PhpSourceSanitization($parser,
                            str_replace(" ", $whiteSpace,
                                $sourceCode)))->stringContent());
                    $this->assertEquals($sourceCodeSanitized,
                        (new PhpSourceSanitization($parser,
                            $sourceCodeSanitized))->stringContent());
                    $this->assertEquals($sourceCodeSanitized . '?> <p>strip this</p>',
                        (new PhpSourceSanitization($parser,
                            str_replace(" ", $whiteSpace,
                                $sourceCode . '?> <p>strip this</p>')))->stringContent());
                    $this->assertEquals($sourceCodeSanitized . '?> <p>strip this</p>' . $sourceCodeSanitized,
                        (new PhpSourceSanitization($parser,
                            str_replace(" ", $whiteSpace,
                                $sourceCode . '?> <p>strip this</p>' . $sourceCode)))->stringContent());
                }
            }
        }
    }
}