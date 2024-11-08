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

    private function compile(string $value, string $divider = '-'): string
    {
        return <<<PHP
            (function () use (\$input) : string {
                \$text = preg_replace('~[^\\pL\\d]+~u', {$divider}, {$value});
                \$text = iconv('utf-8', 'us-ascii//TRANSLIT', \$text);
                \$text = preg_replace('~[^-\\w]+~', '', \$text);
                \$text = trim(\$text, {$divider});
                \$text = preg_replace('~-+~', {$divider}, \$text);
                \$text = strtolower(\$text);

                if (strlen(\$text) <= 0) {
                    return '';
                }

                return \$text;
            })()
            PHP;
    }

    private function evaluate(array $context, string $value, string $divider = '-'): string
    {
        $text = preg_replace('~[^\pL\d]+~u', $divider, $value);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^\-\w]+~', '', $text);
        $text = trim($text, $divider);
        $text = preg_replace('~-+~', $divider, $text);
        $text = strtolower($text);

        if (\strlen($text) <= 0) {
            return 'n-a';
        }

        return $text;
    }
}
