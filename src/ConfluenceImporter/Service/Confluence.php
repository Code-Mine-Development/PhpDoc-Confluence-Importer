<?php

namespace CodeMine\ConfluenceImporter\Service;

use CodeMine\ConfluenceImporter\Documentation\PageInterface;
use CodeMine\ConfluenceImporter\Service\Confluence\InstanceInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Stream;

/**
 * Class Confluence
 *
 * @package CodeMine\ConfluenceImporter\Service
 */
class Confluence
{
    const ADD_PAGE = 'rest/api/content';
//    const ADD_PAGE = 'sb0x2gsb'; //requestb.in
    const SEARCH_PAGE = 'rest/api/content/search';

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    private $client;
    /**
     * @var \CodeMine\ConfluenceImporter\Service\Confluence\InstanceInterface
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
        $this->client = $client;
        $this->confluenceInstance = $confluenceInstance;
    }

    public function createPage($key, array $page, PageInterface $parentPage = NULL)
    {
        foreach ($page as $item) {
            $this->generateNewPage($key, $item, $parentPage);
        }
    }

    /**
     * @param $key
     * @param PageInterface $page
     * @param PageInterface|NULL $parentPage
     * @param null $id
     */
    private function generateNewPage($key, PageInterface $page, PageInterface $parentPage = NULL, $id = NULL)
    {
        /** @var PageInterface $page */

            $body    = $this->getBody($key, $page, $parentPage, $id);
            $headers = $this->getHeaders();

            try {
                $request      = $this->getRequest($headers, $body);
                $response     = $this->client->send($request); //TODO: find solution for exception on same page name
                $pageChildren = $page->children();

                $newPageId = json_decode($response->getBody()->getContents())->id;

                if (NULL !== $pageChildren) {
                    foreach ($pageChildren as $pageChild) {
                        $this->generateNewPage($key, $pageChild, $page, $newPageId);
                    }
                }
            } catch (ClientException $e) {
                //silent
                echo '============================================';
                var_dump($e->getMessage());die;
            }
    }

    public function getPageId($key, PageInterface $page) //TODO::Change for private method
    {
        $headers = [
            'Authorization' => 'Basic ' . $this->getBase64Credentials(),
        ];

        try {

            $response = $this->client->request('GET', self::SEARCH_PAGE, [
                'headers' => $headers,
                'query' => [
                    'cql' => sprintf('title="%s" and space="%s"', $page->title(), $key)

                ],
                'debug' => TRUE
            ]);

        } catch (\Exception $e) {
            //silent
        }

        /** @var Stream $returnBody */
        $returnBody = $response->getBody();

        $stdBody = json_decode($returnBody->getContents());
        if ($response->getStatusCode() == 200 && count($stdBody->results) == 1) {
            $id = (string)$stdBody->results[0]->id;

            return $id;

        }
        throw new \Exception('ERROR!!!!');
    }

    /**
     * @return string
     */
    private function getBase64Credentials()
    {
        $base64Credentials = base64_encode(
            $this->confluenceInstance->username() .
            ':' .
            $this->confluenceInstance->password()
        );

        return $base64Credentials;
    }

    /**
     * @return array
     */
    private function getHeaders()
    {
        $headers = [
            'Authorization' => 'Basic ' . $this->getBase64Credentials(),
            'Content-Type' => 'application/json'
        ];

        return $headers;
    }

    /**
     * @param string $key
     * @param PageInterface $page
     * @param PageInterface|NULL $parentPage
     * @return string<json>
     * @throws \Exception
     */
    private function getBody($key, PageInterface $page, PageInterface $parentPage = NULL, $id = NULL)
    {
        $bodyArray = [
            'type' => 'page',
            'title' => $page->title(),
            'space' => [
                'key' => $key
            ],
            'body' => [
                'storage' => [
                    'value' => $page->content(),
                    'representation' => 'storage'
                ]
            ]
        ];

        if (isset($parentPage)) {
            if (isset($id)){
                $bodyArray['ancestors'] = [
                    ['id' => $id]
                ];
            }else {
                $pageId = $this->getPageId($key, $parentPage);
                $bodyArray['ancestors'] = [
                    ['id' => $pageId]
                ];
            }
        }

        $body = json_encode($bodyArray);

        return $body;
    }

    /**
     * @param $headers
     * @param $body
     * @return Request
     */
    private function getRequest($headers, $body)
    {

        $request = new Request('POST', Confluence::ADD_PAGE, $headers, $body);

        return $request;
    }
}