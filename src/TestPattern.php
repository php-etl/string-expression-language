<?php

declare(strict_types=1);

namespace Kiboko\Component\StringExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;

class TestPattern extends ExpressionFunction
{
    public function __construct($name)
    {
        parent::__construct(
            $name,
            $this->compile(...)->bindTo($this),
            $this->evaluate(...)->bindTo($this)
        );
    }

    private function compile(string $pattern, string $subject): string
    {
        return <<<PHP
                \$result = preg_match({$pattern}, {$subject});
                if (!\$result) {
                    return false;
                } else {
                    return true;
                }
            PHP;
    }

    private function evaluate(array $context, string $pattern, string $subject): bool
    {
        $result = preg_match($pattern, $subject);
        if (!$result) {
            return false;
        }

        return true;
    }
}
