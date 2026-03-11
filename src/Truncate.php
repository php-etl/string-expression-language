<?php

declare(strict_types=1);

namespace Kiboko\Component\StringExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;

final class Truncate extends ExpressionFunction
{
    public function __construct($name)
    {
        parent::__construct(
            $name,
            \Closure::fromCallable($this->compile(...))->bindTo($this),
            \Closure::fromCallable($this->evaluate(...))->bindTo($this)
        );
    }

    private function compile(string $input, string $limit): string
    {
        return <<<PHP
            (
                mb_strlen({$input}) > {$limit} ?
                (
                    rtrim(mb_substr({$input}, 0, {$limit} - 1)) . '…'
                ) : {$input}
            )
            PHP;
    }

    /**
     * @param array<string, mixed> $context
     */
    private function evaluate(array $context, string $input, int $limit): string
    {
        return mb_strlen($input) > $limit ?
            (
                rtrim(mb_substr($input, 0, $limit - 1)).'…'
            ) : $input;
    }
}
