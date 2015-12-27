<?php
use \PhpTranspiler\Framework\PhpSourceSanitization;

class PhpSourceSanitizationTest extends \PHPUnit_Framework_TestCase
{
    public function testStringContent()
    {
        foreach (array("", " ", "\t") as $issueSpace) {
            foreach (array(" ", "\t") as $whiteSpace) {
                $php                 = "echo 'bar'" . $issueSpace . ';';
                $phpSanitized        = "echo 'bar';";
                $sourceCode          = "<?php\n" . $php;
                $sourceCodeSanitized = '<?php ' . $phpSanitized;
                $this->assertEquals($sourceCodeSanitized,
                    (new PhpSourceSanitization(str_replace(" ", $whiteSpace,
                        $sourceCode)))->stringContent());
                $this->assertEquals($sourceCodeSanitized . '?> <p>strip this</p>',
                    (new PhpSourceSanitization(str_replace(" ", $whiteSpace,
                        $sourceCode . '?> <p>strip this</p>')))->stringContent());
                $this->assertEquals($sourceCodeSanitized . '?> <p>strip this</p>' . $sourceCodeSanitized,
                    (new PhpSourceSanitization(str_replace(" ", $whiteSpace,
                        $sourceCode . '?> <p>strip this</p>' . $sourceCode)))->stringContent());
            }
        }
    }
}