## Laravel Schedule Documentator

This package provides automatic generation of documentation for your app schedule 

### Installation

Run commands: 

`composer require artarts36/laravel-schedule-documentator`

`php artisan vendor:publish --provider="ArtARTs36\LaravelScheduleDocumentator\Providers\LaravelScheduleDocumentatorProvider" --tag=config`

---

### Simple generation:

```php
$generator = app(\ArtARTs36\LaravelScheduleDocumentator\Services\DocGenerateHandler::class);

$generator->handle('md', '/path/to/file.md');
$generator->handle('json', '/path/to/file.json');
$generator->handle('csv', '/path/to/file.csv');
```

---

### Console Commands

|  Command  | Description |
| ------------ | ------------ | 
| artisan schedule:doc {format} {path} | Generate documentation |

---

### Available Formats

|  Format  | Documentator Class |
| ------------ | ------------ | 
| Json | ArtARTs36\LaravelScheduleDocumentator\Documentators\JsonDocumentator |
| Csv | ArtARTs36\LaravelScheduleDocumentator\Documentators\CsvDocumentator |
| Md | ArtARTs36\LaravelScheduleDocumentator\Documentators\MarkdownDocumentator |

---

### Installation:

1. Run: `composer require artarts36/laravel-schedule-documentator`
2. Add LaravelScheduleDocumentatorProvider into providers
3. Run: 'php artisan vendor:publish --tag=schedule_doc'

---

### Add Custom Format

1. Create new Documentator (by contract \ArtARTs36\LaravelScheduleDocumentator\Contracts\Documentator)
2. Add entry "extension/documentator" into config/schedule_doc.php in field "ext_documentator"
```php
    [
        'ext_documentator' => [
            // other documentators
            'zip' => MyZipDocumentator::class,
        ],
    ]
```

---

### Command Description

Must fill property `description` in console commands for full documentation.

Use the [PHP CS Fixer rule](https://github.com/ArtARTs36/php-cs-fixer-good-fixers) `PhpCsFixerGoodFixers/laravel_command_no_empty_description` to prevent undescribed commands from entering your repository.  
