<?php

declare(strict_types=1);

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
            ExpressionFunction::fromPhp('ucfirst', 'capitalize'),
            ExpressionFunction::fromPhp('strtolower', 'toLowerCase'),
            ExpressionFunction::fromPhp('substr', 'search'),
            ExpressionFunction::fromPhp('strtoupper', 'toUpperCase'),
            ExpressionFunction::fromPhp('number_format', 'formatNumber'),
            ExpressionFunction::fromPhp('strpos', 'indexOf'),
            ExpressionFunction::fromPhp('str_replace', 'replace'),
            ExpressionFunction::fromPhp('strip_tags', 'clean_up_html'),
            new FileName('fileName'),
            new DateTime('dateTime'),
            new FormatDate('formatDate'),
            new TruncateFileName('truncateFileName'),
            new Now('now'),
        ];
    }
}
