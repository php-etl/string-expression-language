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
            $this->compile(...)->bindTo($this),
            $this->evaluate(...)->bindTo($this)
        );
    }

    private function compile(?string $timezone = null): string
    {
        $timezoneArg = $timezone === null ? 'null' : "{$timezone} !== null ? new \\DateTimeZone({$timezone}) : null";

        return <<<PHP
                (new \\DateTime('now', {$timezoneArg}))
            PHP;
    }

    /**
     * @param array<string, mixed> $context
     */
    private function evaluate(array $context, ?string $timezone = null): \DateTime
    {
        return new \DateTime('now', null !== $timezone ? new \DateTimeZone($timezone) : null);
    }
}
