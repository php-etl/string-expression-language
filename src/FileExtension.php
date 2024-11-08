<?php

declare(strict_types=1);

namespace Kiboko\Component\StringExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;

final class FileExtension extends ExpressionFunction
{
    public function __construct($name)
    {
        parent::__construct(
            $name,
            $this->compile(...)->bindTo($this),
            $this->evaluate(...)->bindTo($this)
        );
    }

    private function compile(string $value): string
    {
        return <<<PHP
            (function () use (\$input) : ?string {
                \$validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'pdf', 'mp4', 'webm', 'mp3'];
                
                \$extension = \\pathinfo({$value})['extension'] ?? null;
                if (!\\in_array(\$extension, \$validExtensions, true)) {
                    return null;
                }
                
                return \$extension;
            })()
            PHP;
    }

    private function evaluate(array $context, string $file): ?string
    {
        $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg'];

        $extension = pathinfo($file)['extension'] ?? null;

        if (!\in_array($extension, $validExtensions, true)) {
            return null;
        }

        return $extension;
    }
}
