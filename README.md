# String Expression Language
This package extends the [ExpressionLanguage](https://symfony.com/doc/current/components/expression_language.html) component of Symfony to compile and evaluate arrays with custom functions.

# Installation
```
composer require php-etl/string-expression-language
```

# Usage
You can use these expressions in your configuration files as in the following example :
```yaml
foo: '@=format("%s", "output")'
```

# List of available functions

## Generic functions
* `format(string $format, mixed ...$values) : string` =>  Return a formatted string
* `trim(string $string, string $characters = " \n\r\t\v\x00") : string` =>  Strip whitespace (or other characters) from the beginning and end of a string
* `capitalize(string $string) : string` =>  Make a string's first character uppercase
* `toLowerCase(string $string) : string` => Make a string lowercase
* `search(string $string, int $offset, ?int $length = null) : string` => Return part of a string
* `toUpperCase(string $string) : string` => Make a string uppercase
* `fileName(string $string) : string` => Returns information about a file path
* `dateTime(string $string) : string` => Returns new DateTimeImmutable object formatted according to the specified format
* `formatDate(string $string) : string` => Returns date formatted according to given format
* `position(string $haystack, string $needle, int $offset) : int|false` => Find the position of the first occurrence of a substring in a string
