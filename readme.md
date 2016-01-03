# PHP Transpiler

This tool transpiles PHP code into optimized PHP code.

Implemented features:

1. Inlines `require` and `include` statements.

2. Strips unnecessary whitespaces from the code.

3. Strips comments from code.

## Example

Run against files test.php and include.php in the same directory given as:

test.php
```
<?php

require 'include.php';

class Foo {
    public function msg() {
        return (new Bar)->msg();
    }
}

echo (new Foo)->msg();
```

include.php

```
<?php

class Bar {
    public function msg() {
        return "Example Return Message\n";  
    }
}

```

Transpiles into a single test.php that contains:

```
<?php  class Bar{public function msg(){return 'Example Return Message
';}}class Foo{public function msg(){return (new Bar())->msg();}}echo (new Foo())->msg();
```

## Usage

## Installation

To install globally via composer run
 
`composer global require brownbear/php-transpiler`

### CLI

Either analyze a source file or directory via:

```
php-transpiler analyze /src
```

or transpile a source directory into `/out` via:

```
php-transpiler transpile /src /out
```

### Library

Not documented yet :/


[![Latest Stable Version](https://poser.pugx.org/brownbear/php-transpiler/v/stable)](https://packagist.org/packages/brownbear/php-transpiler)
[![Latest Unstable Version](https://poser.pugx.org/brownbear/php-transpiler/v/unstable)](//packagist.org/packages/brownbear/php-transpiler)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg?style=flat-square)](https://php.net/)
[![Build Status](https://travis-ci.org/original-brownbear/php-transpiler.svg)](https://travis-ci.org/original-brownbear/php-transpiler)
[![Total Downloads](https://poser.pugx.org/brownbear/php-transpiler/downloads)](https://packagist.org/packages/brownbear/php-transpiler)
[![Code Climate](https://codeclimate.com/github/original-brownbear/php-transpiler/badges/gpa.svg)](https://codeclimate.com/github/original-brownbear/php-transpiler)
[![Test Coverage](https://codeclimate.com/github/original-brownbear/php-transpiler/badges/coverage.svg)](https://codeclimate.com/github/original-brownbear/php-transpiler/coverage)
[![Dependency Status](https://www.versioneye.com/user/projects/567fc289eb4f47003c000092/badge.svg?style=flat)](https://www.versioneye.com/user/projects/567fc289eb4f47003c000092)