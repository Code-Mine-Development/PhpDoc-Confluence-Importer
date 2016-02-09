<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 02.02.16
 * Time: 18:05
 */

namespace CodeMine\ConfluenceImporter\Documentation;


class Page implements PageInterface
{
    private $title;
    private $content;
    private $children;

    public function __construct($title)
    {
        $this->title = $title;
        $this->children = [];
    }

    public function addChildren(PageInterface $page)
    {
        $this->children[$page->title()]= $page;
    }

    public function addContent($content)
    {
        $this->content = $content;
    }

    public function title()
    {
        return $this->title;
    }

    public function content()
    {
        return $this->content;
    }

    public function children()
    {
        return $this->children;
    }

}