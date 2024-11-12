<?php

namespace Kiboko\Component\StringExpressionLanguage;

class TestPattern
{
    public function __construct($name)
    {
        parent::__construct(
            $name,
            $this->compile(...)->bindTo($this),
            $this->evaluate(...)->bindTo($this)
        );
    }

    private function compile(string $pattern, string $subject): bool
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
        } else {
            return true;
        }
    }
}
