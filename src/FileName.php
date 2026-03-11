<?php

declare(strict_types=1);

namespace Kiboko\Component\StringExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;

final class FileName extends ExpressionFunction
{
    public function __construct($name)
    {
        parent::__construct(
            $name,
            $this->compile(...)->bindTo($this),
            $this->evaluate(...)->bindTo($this)
        );
    }

    private function compile(mixed $file): string
    {
        return <<<COMPILED
            (!is_string({$file}) ? null : pathinfo({$file}, PATHINFO_FILENAME))
            COMPILED;
    }

    /**
     * @param array<string, mixed> $context
     */
    private function evaluate(array $context, mixed $file): ?string
    {
        return !\is_string($file) ? null : pathinfo($file, \PATHINFO_FILENAME);
    }
}
