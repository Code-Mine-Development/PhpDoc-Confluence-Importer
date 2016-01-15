<?php

namespace CodeMine\ConfluenceImporter\Service;

use CodeMine\ConfluenceImporter\Documentation\PageInterface;
use CodeMine\ConfluenceImporter\Service\Confluence\InstanceInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
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

        $body = $this->getBody($key, $page, $parentPage);
        $headers = $this->getHeaders();



        try {
            $request = $this->getRequest($headers, $body);
            $response = $this->client->send($request); //TODO: find solution for exception on same page name
            $pageChildren = $page->children();
            if (null !== $pageChildren){
                var_dump('1');
                var_dump(urlencode('"sda sd"'));die;
                foreach($pageChildren as $pageChild){
                    var_dump('2');

                    $childBody = $this->getBody($key, $pageChild, $page);
                    var_dump('child body');
                    $childRequest = $this->getRequest($headers, $pageChild);
                    try {
                        var_dump('3');

                        $this->client->send($request);
                    }catch(\Exception $e){
                        var_dump($e->getMessage());
                    }
                }

                var_dump(urlencode('"sda sd"'));die;

            }
//            var_dump($response->);
        }catch(ClientException $e){

            echo 'ERROR!';
            var_dump($e->getMessage());
            echo 'ERROR!!!';

            return FALSE;
        }
        $returnBody = $response->getBody();
        $stdBody = json_decode($returnBody->getContents());
        $pageId = (string)$stdBody->id;

        return TRUE;
    }

    public function getPageId(string $key, PageInterface $page) //TODO::Change for private method
    {
        $headers = [
            'Authorization' => 'Basic ' . $this->getBase64Credentials(),
        ];

        $url = sprintf(Confluence::SEARCH_PAGE, $page->title(), $key);
        var_dump($url);


        var_dump('ID');
        $request = new Request('GET', $url, $headers);

        try {
            var_dump('try');
//var_dump($request);die;
            $response = $this->client->send($request);
        }catch(\Exception $e){
            var_dump('EEEEEEEEEEEEEEEERRRROOOOOOOOOOOOR');
            var_dump($e->getMessage());
            die;
        }
var_dump($response->getBody());die;
        /** @var Stream $returnBody */
        $returnBody = $response->getBody();
        $returnBody->
        $e = $response->getHeaders();

        $stdBody = json_decode($returnBody->getContents());

//        var_dump($stdBody);
//        var_dump($response->getStatusCode());
//        var_dump(count($stdBody->results));
//        var_dump($stdBody->results);

        if ($response->getStatusCode() == 200 && count($stdBody->results) == 1){

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
    private function getBody(string $key, PageInterface $page, PageInterface $parentPage = NULL)
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
            $parentPageId = $this->getPageId($key, $parentPage);

            $bodyArray['ancestors'] = [
                ['id' => $parentPageId]
            ];
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
/*
curl -u admin:admin -X POST -H 'Content-Type: application/json' -d'
{"type":"page",
"title":"new page",
 ancestors:[{"id":456}], "space":{"key":"TST"},"body":{"storage":{"value":"<p>This is a new page</p>",
"representation":"storage"}}}' http://localhost:8080/confluence/rest/api/content/ | python -mjson.tool
*/