<?php
namespace PhpTranspiler\Command;

require_once dirname(__DIR__) . '/constants.php';
use PhpTranspiler\Framework\SourceFactory;
use Symfony\Component\Console\Command\Command;

/**
 * Class AnalyzeCommand
 * @package PhpTranspiler\Command
 *
 * Analyzes a given source file or directory for possible optimizations
 */
class PhpTranspilerCommand extends Command
{
    use SourceFactory;
}
