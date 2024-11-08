<?php

declare(strict_types=1);

namespace Kiboko\Component\StringExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;

final class FileExtension extends ExpressionFunction
{
    public function __construct($name)
    {
        parent::__construct(
            $name,
            $this->compile(...)->bindTo($this),
            $this->evaluate(...)->bindTo($this)
        );
    }

    private function compile(string $value): string
    {
        return <<<PHP
            (function () use (\$input) : string {
                 return \\pathinfo($value, \FILEINFO_EXTENSION)
            })()
            PHP;
    }

    private function evaluate(array $context, string $file): string
    {
        return pathinfo($file, \FILEINFO_EXTENSION);
    }
}
