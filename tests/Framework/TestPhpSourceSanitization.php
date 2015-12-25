<?php
use \PhpTranspiler\Framework\PhpSourceSanitization;

class PhpSourceSanitizationTest extends \PHPUnit_Framework_TestCase
{
    public function testStringContent()
    {
        $php        = "\necho 'bar';";
        $sourceCode = '<?php' . $php;
        $this->assertEquals($sourceCode,
            (new PhpSourceSanitization($sourceCode))->stringContent());
        $this->assertEquals($sourceCode,
            (new PhpSourceSanitization($sourceCode . '?> <p>strip this</p>'))->stringContent());
        $this->assertEquals($sourceCode . $php,
            (new PhpSourceSanitization($sourceCode . '?> <p>strip this</p>' . $sourceCode))->stringContent());
    }
}