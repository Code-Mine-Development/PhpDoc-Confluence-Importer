<?php
/**
     * Creator: adamgrabek
     * Date: 13.01.2016
     * Time: 14:54
     */

namespace CodeMine\ConfluenceImporter\Service;

use CodeMine\ConfluenceImporter\Service\Confluence\InstanceInterface;
use GuzzleHttp\ClientInterface;

/**
 * Class Confluence
 *
 * @package CodeMine\ConfluenceImporter\Service
 */
class Confluence
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    private $client;
    /**
     * @var \CodeMine\ConfluenceImporter\Service\InstanceInterface
     */
    private $confluenceInstance;

    /**
     * Confluence constructor.
     *
     * @param \GuzzleHttp\ClientInterface $client
     * @param \CodeMine\ConfluenceImporter\Service\Confluence\InstanceInterface $confluenceInstance
     */
    public function __construct(ClientInterface $client, InstanceInterface $confluenceInstance)
    {
        $this->client             = $client;
        $this->confluenceInstance = $confluenceInstance;
    }
}