<?php
/**
 * Creator: adamgrabek
 * Date: 13.01.2016
 * Time: 15:01
 */

namespace CodeMine\ConfluenceImporter\Service\Confluence;

/**
 * Interface InstanceInterface
 *
 * @package CodeMine\ConfluenceImporter\Service
 */
interface InstanceInterface
{
    /**
     * @return string
     */
    public function username();

    /**
     * @return string
     */
    public function password();

    /**
     * @return string
     */
    public function url();

    /**
     * @return bool
     */
    public function useContext();
}