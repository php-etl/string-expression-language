<?php

declare(strict_types=1);

namespace Kiboko\Component\StringExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;

class Now extends ExpressionFunction
{
    public function __construct($name)
    {
        parent::__construct(
            $name,
            \Closure::fromCallable($this->compile(...))->bindTo($this),
            \Closure::fromCallable($this->evaluate(...))->bindTo($this)
        );
    }

    private function compile(string $timezone = null)
    {
        return <<<PHP
                (new \\DateTime('now', {$timezone} !== null ? new \\DateTimeZone({$timezone}) : null))
            PHP;
    }

    private function evaluate(array $context, string $timezone = null)
    {
        return new \DateTime('now', null !== $timezone ? new \DateTimeZone($timezone) : null);
    }
}
