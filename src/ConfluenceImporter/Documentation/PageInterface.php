<?php
/**
 * Creator: adamgrabek
 * Date: 13.01.2016
 * Time: 15:25
 */

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
}