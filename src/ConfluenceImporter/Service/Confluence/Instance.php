<?php
/**
 * Creator: adamgrabek
 * Date: 13.01.2016
 * Time: 15:06
 */

namespace CodeMine\ConfluenceImporter\Service\Confluence;

/**
 * Class Instance
 *
 * @package CodeMine\ConfluenceImporter\Service
 */
class Instance implements InstanceInterface
{
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $password;
    /**
     * @var bool
     */
    private $useContext;


    /**
     * Instance constructor.
     *
     * @param $url
     * @param $username
     * @param $password
     * @param $useContext
     */
    public function __construct($url, $username, $password, $useContext)
    {
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;
        $this->useContext = $useContext;
    }

    public function username()
    {
        return $this->username;
    }

    public function password()
    {
        return $this->password;
    }

    public function url()
    {
        return $this->url;
    }

    public function useContext()
    {
        return $this->useContext;
    }

}