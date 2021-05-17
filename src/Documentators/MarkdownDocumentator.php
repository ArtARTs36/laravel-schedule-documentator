<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Documentators;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\Documentator;
use ArtARTs36\LaravelScheduleDocumentator\Data\Document;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;
use ArtARTs36\LaravelScheduleDocumentator\Exceptions\TemplateNotFound;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\View\Factory;

class MarkdownDocumentator extends AbstractDocumentator implements Documentator
{
    protected $view;
    protected $template;

    public function __construct(Filesystem $files, Factory $view, string $template)
    {
        parent::__construct($files);

        $this->view = $view;
        $this->setTemplate($template);
    }

    /**
     * @throws \ArtARTs36\LaravelScheduleDocumentator\Exceptions\TemplateNotFound
     */
    public function setTemplate(string $template): self
    {
        if (! $this->view->exists($template)) {
            throw new TemplateNotFound($template);
        }

        $this->template = $template;

        return $this;
    }

    public function document(EventCollection $events, string $path): Document
    {
        return $this->saveContent($path, $this->getMarkdown($events));
    }

    public function getMarkdown(EventCollection $events): string
    {
        return $this->view->make($this->template, [
            'events' => $events,
        ])->render();
    }
}
