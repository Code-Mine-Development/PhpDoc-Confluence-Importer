<?php
/**
 * Creator: adamgrabek
 * Date: 13.01.2016
 * Time: 14:54
 */

namespace CodeMine\ConfluenceImporter\Service;

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
     * Confluence constructor.
     *
     * @param \GuzzleHttp\ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}