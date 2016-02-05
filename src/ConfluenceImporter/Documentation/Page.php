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

    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
        $this->children = [];
    }

    public function addChildren(PageInterface $page)
    {
        array_push($this->children, $page);
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