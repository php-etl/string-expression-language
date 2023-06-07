<?php declare(strict_types=1);

namespace Kiboko\Component\StringExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\String\Slugger\AsciiSlugger;

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

    private function compile(string $value, string $separator = '-'): string
    {
        return <<<PHP
            (function () use (\$input) : string {
                \$string = strtolower({$value});

                \$string = preg_replace('/[^\p{L}\p{Nd}\/]+/u', {$separator}, \$string);

                \$string = str_replace('é', {$separator}, \$string);

                return trim(\$string, {$separator});
            })()
            PHP;
    }

    private function evaluate(array $context, string $value, string $separator): string
    {
        $string = strtolower($value);

        $string = preg_replace('/[^\p{L}\p{Nd}\/]+/u', $separator, $string);

        $string = str_replace('é', $separator, $string);

        return trim($string, $separator);
    }
}
