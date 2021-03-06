[![Build Status](https://travis-ci.org/Code-Mine-Development/PhpDoc-Confluence-Importer.svg?branch=master)](https://travis-ci.org/Code-Mine-Development/PhpDoc-Confluence-Importer) 
[![Code Coverage](https://scrutinizer-ci.com/g/Code-Mine-Development/PhpDoc-Confluence-Importer/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Code-Mine-Development/PhpDoc-Confluence-Importer/?branch=master)
[![VersionEye](https://www.versioneye.com/user/projects/569641bfaf789b0027001a2b/badge.svg)](https://www.versioneye.com/user/projects/569641bfaf789b0027001a2b)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Code-Mine-Development/PhpDoc-Confluence-Importer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Code-Mine-Development/PhpDoc-Confluence-Importer/?branch=master)

# PhpDoc Confluence Importer

Library that allows to import php documentation into Confluence via rest api

Designed to work with PhpDocumentator xml output and PhpUnit testdox html files.

Different documentation/build artifact exporters are also considered. 

## TODO

1. Confluence API OO wrapper
2. XML to page data converter
3. Wiki renderer
4. Page exporter
5. CLI interface

## Usage (Planned)

```
php doc2confluence.php [command] [args]  

commands:
export phpdoc
  -s --source : source xml file generated by PhpDocumentor
  -c --credentials : username:password - Confluence user credentials that has access to desired space
  -S --space : space key to which pages need to be imported
  -h --host : Confluence instance url
  -p --parent : identifier of the parent page, if not provided, pages will be created in space root
  
export testdox
  -s --source : source file generated by Phpunit
  -c --credentials : username:password - Confluence user credentials that has access to desired space
  -S --space : space key to which page need to be imported
  -h --host : Confluence instance url
  -p --parent : identifier of the parent page, if not provided, pages will be created in space root

```


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/Code-Mine-Development/phpdoc-confluence-importer/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

