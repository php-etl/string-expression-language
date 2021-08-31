<?php

declare(strict_types=1);

namespace Kiboko\Component\StringExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;

class FormatDate extends ExpressionFunction
{
    public function __construct($name)
    {
        parent::__construct(
            $name,
            \Closure::fromCallable([$this, 'compile'])->bindTo($this),
            \Closure::fromCallable([$this, 'evaluate'])->bindTo($this)
        );
    }

    private function compile(string $dateTime, string $format)
    {
        return <<<"PHP"
            {$dateTime}->format({$format})
        PHP;
    }

    private function evaluate(array $context, string $dateTime, string $format)
    {
        return $dateTime->format($format);
    }
}
