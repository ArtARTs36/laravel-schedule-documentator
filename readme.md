## Laravel Schedule Documentator

---

### Simple generation:

```php
$generator = app(\ArtARTs36\LaravelScheduleDocumentator\Services\DocGenerateHandler::class);

$generator->handle('md', '/path/to/file.md');
$generator->handle('json', '/path/to/file.json');
$generator->handle('csv', '/path/to/file.csv');
```

### Console Commands

|  Command  | Description |
| ------------ | ------------ | 
| artisan schedule:doc {format} {path} | Generate documentation |

### Available Formats

|  Format  | Documentator Class |
| ------------ | ------------ | 
| Json | ArtARTs36\LaravelScheduleDocumentator\Documentators\JsonDocumentator |
| Csv | ArtARTs36\LaravelScheduleDocumentator\Documentators\CsvDocumentator |
| Md | ArtARTs36\LaravelScheduleDocumentator\Documentators\MarkdownDocumentator |

---

### Installation:

1. Run: `composer require artarts36/laravel-schedule-documentator --tag=schedule_doc`
2. Run: 'php artisan vendor:publish'