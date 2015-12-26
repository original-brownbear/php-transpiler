<?php
use \PhpTranspiler\Framework\PhpSourceSanitization;

class PhpSourceSanitizationTest extends \PHPUnit_Framework_TestCase
{
    public function testStringContent()
    {
        $php                 = "echo 'bar';";
        $sourceCode          = "<?php\n" . $php;
        $sourceCodeSanitized = '<?php ' . $php;
        $this->assertEquals($sourceCodeSanitized,
            (new PhpSourceSanitization($sourceCode))->stringContent());
        $this->assertEquals($sourceCodeSanitized,
            (new PhpSourceSanitization($sourceCode . '?> <p>strip this</p>'))->stringContent());
        $this->assertEquals($sourceCodeSanitized . $php,
            (new PhpSourceSanitization($sourceCode . '?> <p>strip this</p>' . $sourceCode))->stringContent());
    }
}