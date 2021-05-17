<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Documentators;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\Documentator;
use ArtARTs36\LaravelScheduleDocumentator\Contracts\DocumentContent;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;
use ArtARTs36\LaravelScheduleDocumentator\Data\StringDocumentContent;
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

    public function content(EventCollection $events): DocumentContent
    {
        return new StringDocumentContent($this->render($events));
    }

    protected function render(EventCollection $events): string
    {
        return $this->view->make($this->template, [
            'events' => $events,
        ])->render();
    }
}
