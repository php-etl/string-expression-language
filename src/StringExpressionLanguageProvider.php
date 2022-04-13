<?php

namespace Kiboko\Component\StringExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;

class StringExpressionLanguageProvider implements ExpressionFunctionProviderInterface
{
    public function getFunctions(): array
    {
        return [
            ExpressionFunction::fromPhp('sprintf', 'format'),
            ExpressionFunction::fromPhp('trim', 'trim'),
            ExpressionFunction::fromPhp('ucfirst'),
            ExpressionFunction::fromPhp('strtolower'),
            ExpressionFunction::fromPhp('substr'),
            ExpressionFunction::fromPhp('strtoupper'),
            new FileName('fileName'),
            new DateTime('dateTime'),
            new FormatDate('formatDate'),
            new TruncateFileName('truncateFileName'),
        ];
    }
}
