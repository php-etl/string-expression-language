<?php

declare(strict_types=1);

namespace Kiboko\Component\StringExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;

final class Slugify extends ExpressionFunction
{
    public function __construct($name)
    {
        parent::__construct(
            $name,
            $this->compile(...)->bindTo($this),
            $this->evaluate(...)->bindTo($this)
        );
    }

    private function compile(string $value, string $separator = '_'): string
    {
        return <<<PHP
            (function () use (\$input) : string {
                \$string = strtolower({$value});

                \$string = preg_replace('/[^\\p{L}\\p{Nd}\\/]+/u', {$separator}, \$string);

                \$string = str_replace('é', {$separator}, \$string);
                
                \$string = str_replace('/', {$separator}, \$string);

                return trim(\$string, {$separator});
            })()
            PHP;
    }

    private function evaluate(array $context, string $value, string $separator = '_'): string
    {
        $string = strtolower($value);

        $string = preg_replace('/[^\\p{L}\\p{Nd}\\/]+/u', $separator, $string);

        $string = str_replace('é', $separator, $string);

        $string = str_replace('/', $separator, $string);

        return trim($string, $separator);
    }
}
