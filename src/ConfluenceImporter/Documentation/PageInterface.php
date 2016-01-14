<?php

namespace CodeMine\ConfluenceImporter\Documentation;

/**
 * Interface PageInterface
 *
 * @package CodeMine\ConfluenceImporter\Documentation
 */
interface PageInterface
{
    /**
     * @return string
     */
    public function title();

    /**
     * @return string
     */
    public function content();

    /**
     * @return array<PageInterface>
     */
    public function children();
}