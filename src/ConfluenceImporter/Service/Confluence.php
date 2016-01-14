<?php

namespace CodeMine\ConfluenceImporter\Service;

use CodeMine\ConfluenceImporter\Documentation\PageInterface;
use CodeMine\ConfluenceImporter\Service\Confluence\InstanceInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;

/**
 * Class Confluence
 *
 * @package CodeMine\ConfluenceImporter\Service
 */
class Confluence
{
    const ADD_PAGE = 'rest/api/content';
    const SEARCH_PAGE = 'rest/api/content/search?cql=title="%s" and space="%s"';

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
        $this->client = $client;
        $this->confluenceInstance = $confluenceInstance;
    }

    public function createNewPage(string $key, PageInterface $page, PageInterface $parentPage = NULL)
    {
        $title = $page->title();
        $content = $page->content();
        $pageArray = $page->children();

        $bodyArray = [
            'type' => 'page',
            'title' => $title,
            'space' => [
                'key' => $key
            ],
            'body' => [
                'storage' => [
                    'value' => $content,
                    'representation' => 'storage'
                ]
            ]
        ];

        if (isset($parentPage)){
            $bodyArray['ancestors'] = [
              ['id' => $pageId]
                ];
        }


        $headers = [
            'Authorization' => 'Basic ' . $this->getBase64Credentials(),
            'Content-Type' => 'application/json'
        ];



//
        $body = json_encode($bodyArray);
        var_dump($bodyArray);
//        var_dump($headers);
//        var_dump(Confluence::ADD_PAGE);
//        var_dump($body);

        $request = new Request('POST', Confluence::ADD_PAGE, $headers, $body);

        try {
            $response = $this->client->send($request); //TODO: put in try and find solution for exception on same page name
            var_dump($response);
        }catch(ClientException $e){

            echo 'ERROR!!!';
            var_dump($e->getMessage());
            echo 'ERROR!!!';
            die;
        }
        $returnBody = $response->getBody();

        $stdBody = json_decode($returnBody->getContents());

        $pageId = (string)$stdBody->id;

        $bodyArray = [
            'type' => 'page',
            'title' => $title,
            'ancestors' => [
              ['id' => $pageId]
            ],
            'space' => [
                'key' => $key
            ],
            'body' => [
                'storage' => [
                    'value' => $content,
                    'representation' => 'storage'
                ]
            ]
        ];
    }

    public function getPageId(string $key, PageInterface $page) //TODO::Change for private method
    {
        $headers = [
            'Authorization' => 'Basic ' . $this->getBase64Credentials(),
        ];

        $url = sprintf(Confluence::SEARCH_PAGE, $page->title(), $key);

//        var_dump($url);

        $request = new Request('GET', $url, $headers);

        try {
            $response = $this->client->send($request);
        }catch(\Exception $e){
            var_dump('EEEEEEEEEEEEEEEERRRROOOOOOOOOOOOR');
            var_dump($e->getMessage());
            die;
        }
//        var_dump($response);

        $returnBody = $response->getBody();
        $e = $response->getHeaders();
//        var_dump($e);

//        var_dump($response->getStatusCode());


//        var_dump($returnBody);
//        var_dump(json_decode($returnBody->getContents()));die;
//        die;

        $stdBody = json_decode($returnBody->getContents());

//        var_dump($stdBody);
//        die;
        if ($response->getStatusCode() == 200 && count($stdBody->results) == 1){

            $id = (string)$stdBody->results[0]->id;

//            var_dump($id);die;
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
}
/*
curl -u admin:admin -X POST -H 'Content-Type: application/json' -d'
{"type":"page",
"title":"new page",
 ancestors:[{"id":456}], "space":{"key":"TST"},"body":{"storage":{"value":"<p>This is a new page</p>",
"representation":"storage"}}}' http://localhost:8080/confluence/rest/api/content/ | python -mjson.tool
*/