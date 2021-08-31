<?php

declare(strict_types=1);

namespace Kiboko\Component\StringExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;

class DateTime extends ExpressionFunction
{
    public function __construct($name)
    {
        parent::__construct(
            $name,
            \Closure::fromCallable([$this, 'compile'])->bindTo($this),
            \Closure::fromCallable([$this, 'evaluate'])->bindTo($this)
        );
    }

    private function compile(string $date, string $format, string $timezone = null)
    {
        return <<<"PHP"
            \\DateTimeImmutable::createFromFormat({$format}, {$date}, {$timezone} !== null ? new \\DateTimeZone({$timezone}) : null)
        PHP;
    }

    private function evaluate(array $context, string $date, string $format, string $timezone = null)
    {
        return \DateTimeImmutable::createFromFormat($format,$date, $timezone !== null ? new \DateTimeZone($timezone) : null);
    }
}
