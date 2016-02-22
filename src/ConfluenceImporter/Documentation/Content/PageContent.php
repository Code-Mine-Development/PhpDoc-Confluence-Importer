<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 11.02.16
 * Time: 13:36
 */

namespace CodeMine\ConfluenceImporter\Documentation\Content;


use CodeMine\ConfluenceImporter\Parser\Structure\Attribute\NameClass;
use CodeMine\ConfluenceImporter\Parser\Structure\DocClass;
use CodeMine\ConfluenceImporter\Parser\Structure\Method\Method;
use CodeMine\ConfluenceImporter\Parser\Structure\Method\Param\Collection\Params;
use CodeMine\ConfluenceImporter\Parser\Structure\Method\Param\Param;
use CodeMine\ConfluenceImporter\Parser\Structure\Structure;

class PageContent
{
    /**
     * @var NameClass
     */
    private $name;
    private $package;
    private $extend;

    private $description;
    private $longDescription;

    /**
     * @var \SplObjectStorage
     */
    private $methods;

    /**
     * @var Params
     */
    private $params;

    /**
     * PageContent constructor.
     * @param Structure $data
     */
    public function __construct(Structure $data)
    {
        if(FALSE === ($data instanceof Structure)){
            throw new \InvalidArgumentException('Class must extend Structure class, please provide valid data');
        }
        $this->prepareData($data);
    }

    /**
     * @param $data
     */
    private function prepareData(Structure $data)
    {
        $this->name = $data->getName();
        $this->package = $data->getPackage();
        $this->extend = ($data instanceof DocClass) ? $data->getExtend() : NULL;
        $this->methods = ($data instanceof DocClass) ? $data->getMethods() : NULL;

        $this->description = $data->getDescription();
        $this->longDescription = $data->getLongDescription();

//        $this->params =  ($data instanceof DocClass) ? $data-> : NULL;

    }

    public function getXhtmlForPageContent()
    {
        $xhtml = "
        <ac:layout><ac:layout-section ac:type=\"single\"><ac:layout-cell><ac:structured-macro ac:macro-id=\"3e74101c-857f-4c47-8618-a27c627eea2c\" ac:name=\"info\" ac:schema-version=\"1\"><ac:parameter ac:name=\"title\">Fully qualified class name</ac:parameter><ac:rich-text-body>{$this->name->fullName()}</ac:rich-text-body></ac:structured-macro>

</ac:layout-cell></ac:layout-section><ac:layout-section ac:type=\"two_left_sidebar\"><ac:layout-cell>
<h2>Class contents</h2>
<p><ac:structured-macro ac:macro-id=\"726aa6fa-6e48-4005-95ad-0fb28aae8162\" ac:name=\"toc\" ac:schema-version=\"1\"><ac:parameter ac:name=\"maxLevel\">4</ac:parameter><ac:parameter ac:name=\"minLevel\">3</ac:parameter></ac:structured-macro></p>
<p>&nbsp;</p></ac:layout-cell><ac:layout-cell>
<h2>Description</h2>
<p><ac:structured-macro ac:macro-id=\"c7feab99-a70b-4ab8-bbac-846ed981bed0\" ac:name=\"excerpt\" ac:schema-version=\"1\"><ac:parameter ac:name=\"atlassian-macro-output-type\">INLINE</ac:parameter><ac:rich-text-body>
<p>{$this->description}</p></ac:rich-text-body></ac:structured-macro>&nbsp;</p>
<h2>Class details</h2>
<table style=\"letter-spacing: 0.1px;\">
<tbody>
<tr>
<th>Package</th>
<td>{$this->package}</td></tr>
<tr>
<th>Inherited from</th>
<td><span style=\"color: rgb(68,68,68);\">{$this->extend}</span></td></tr></tbody></table>
<h3>Methods</h3>
<hr>

{$this->writeDownMethods()}

</ac:layout-cell></ac:layout-section></ac:layout>
        ";

        return $xhtml;
    }

    private function writeDownMethods()
    {
        if(!isset($this->methods)){
            return;
        }

        $string = "";
        $this->methods->rewind();

        /** @var Method $method */
        foreach($this->methods as $method){
            $string .= "
    <ac:structured-macro ac:macro-id=\"43484e81-d0fd-4d40-b990-a7d90cd2b565\" ac:name=\"panel\" ac:schema-version=\"1\"><ac:parameter ac:name=\"borderStyle\">solid</ac:parameter><ac:rich-text-body>
    <h4>&nbsp;<span style=\"color: rgb(51,51,51);\">::{$method->name()}</span></h4>
    <p><span style=\"color: rgb(51,51,51);\">&nbsp;</span></p>
    <p>{$method->description()}</p><ac:structured-macro ac:macro-id=\"9de243a9-ca88-45e1-a6d4-7ff9b542babd\" ac:name=\"code\" ac:schema-version=\"1\"><ac:parameter ac:name=\"language\">php</ac:parameter><ac:parameter ac:name=\"theme\">Confluence</ac:parameter><ac:plain-text-body><![CDATA[{$method->name()}({$this->writeDownParamsForMethod($method)})]]></ac:plain-text-body></ac:structured-macro>
    <h5>Parameters</h5><ac:structured-macro ac:macro-id=\"a2230db4-ea43-4e99-89d9-2661a57fd5c3\" ac:name=\"expand\" ac:schema-version=\"1\"><ac:rich-text-body>
    <table>
        <tbody>
            <tr>
                <th>Parameter</th>
                <th>Data type</th>
                <th>Description</th></tr>
            {$this->writeDownParamsForTable($method)}
        </tbody>
    </table>
    </ac:rich-text-body></ac:structured-macro></ac:rich-text-body></ac:structured-macro>
";
        }
        return $string;
    }

    private function writeDownParamsForMethod(Method $method)
    {

        $counter = 0;
        $string = '';

        /** @var Param $param */
        foreach ($method->params() as $param){
            if ($counter != 0){
                $string .= ', ';
            }
            $string .= $param->type() . ' ' . $param->name();
            $counter++;
        }
        return $string;
    }

    private function writeDownParamsForTable(Method $method)
    {

        $string = '<tr>';

        /** @var Param $param */
        foreach($method->params() as $param){
            $string .= "
                    <td>{$param->name()}</td>
                    <td>{$param->type()}</td>
                    <td>&nbsp;</td>
                    ";
        }
        $string .= '</tr>';

        return $string;
    }


}
/*
<ac:layout><ac:layout-section ac:type="single"><ac:layout-cell><ac:structured-macro ac:macro-id="3e74101c-857f-4c47-8618-a27c627eea2c" ac:name="info" ac:schema-version="1"><ac:parameter ac:name="title">Fully qualified class name</ac:parameter><ac:rich-text-body>\Zend\Authentication\Adapter\Digest</ac:rich-text-body></ac:structured-macro>

<p><a href="https://github.com/zendframework/zend-authentication/blob/master/src/Adapter/Digest.php">Browse source code</a></p></ac:layout-cell></ac:layout-section><ac:layout-section ac:type="two_left_sidebar"><ac:layout-cell>
<h2>Class contents</h2>
<p><ac:structured-macro ac:macro-id="726aa6fa-6e48-4005-95ad-0fb28aae8162" ac:name="toc" ac:schema-version="1"><ac:parameter ac:name="maxLevel">4</ac:parameter><ac:parameter ac:name="minLevel">3</ac:parameter></ac:structured-macro></p>
<p>&nbsp;</p></ac:layout-cell><ac:layout-cell>
<h2>Description</h2>
<p><ac:structured-macro ac:macro-id="c7feab99-a70b-4ab8-bbac-846ed981bed0" ac:name="excerpt" ac:schema-version="1"><ac:parameter ac:name="atlassian-macro-output-type">INLINE</ac:parameter><ac:rich-text-body>
<p>Digest adapter for Zend Authentication mechanism</p></ac:rich-text-body></ac:structured-macro>&nbsp;</p>
<h2>Class details</h2>
<table style="letter-spacing: 0.1px;">
<tbody>
<tr>
<th>Package</th>
<td>\Zend\Authentication\Adapter</td></tr>
<tr>
<th>Inherited from</th>
<td><span style="color: rgb(68,68,68);">\Zend\Authentication\Adapter\AbstractAdapter</span></td></tr></tbody></table>
<h3>Methods</h3>
<hr /><ac:structured-macro ac:macro-id="43484e81-d0fd-4d40-b990-a7d90cd2b565" ac:name="panel" ac:schema-version="1"><ac:parameter ac:name="borderStyle">solid</ac:parameter><ac:rich-text-body>
<h4>&nbsp;<span style="color: rgb(51,51,51);">::__construct()</span></h4>
<hr />
<p><span style="color: rgb(51,51,51);">&nbsp;</span></p>
<p>Sets adapter options</p><ac:structured-macro ac:macro-id="9de243a9-ca88-45e1-a6d4-7ff9b542babd" ac:name="code" ac:schema-version="1"><ac:parameter ac:name="language">php</ac:parameter><ac:parameter ac:name="theme">Confluence</ac:parameter><ac:plain-text-body><![CDATA[__construct(mixed $filename = null, mixed $realm = null, mixed $identity = null, mixed $credential = null)]]></ac:plain-text-body></ac:structured-macro>
<h5>Parameters</h5><ac:structured-macro ac:macro-id="a2230db4-ea43-4e99-89d9-2661a57fd5c3" ac:name="expand" ac:schema-version="1"><ac:rich-text-body>

<table>
<tbody>

<tr>
    <th>Parameter</th>
    <th>Data type</th>
    <th>Description</th></tr>
<tr>
    <td>$filename</td>
    <td>mixed</td>
    <td>&nbsp;</td></tr>
<tr>
    <td>$realm</td>
    <td>mixed</td>
    <td>&nbsp;</td></tr>
</tbody></table>

</ac:rich-text-body></ac:structured-macro></ac:rich-text-body></ac:structured-macro></ac:layout-cell></ac:layout-section></ac:layout>
*/
