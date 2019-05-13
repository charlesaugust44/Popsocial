<?php

namespace App\View;

use DOMDocument;
use DOMText;

class View
{
    private
        $DOM,
        $data;

    public function __construct($viewAlias)
    {
        $this->data = array();
        $this->DOM = $this->loadHTML($viewAlias);
    }

    private function loadHTML($viewAlias)
    {
        $filename = __DIR__ . "/../../resources/views/" . $viewAlias . ".php";
        libxml_use_internal_errors(true);
        if (!file_exists($filename))
            throw new ViewException("View `$viewAlias` doesn´t exist");
        $doc = new DOMDocument();
        $doc->loadHTMLFile($filename);
        return $doc;
    }

    private function array_first(array $arr)
    {
        foreach ($arr as $key => $unused) {
            return $key;
        }
        return NULL;
    }

    private function searchData($needle)
    {
        $result = array_filter($this->data, function ($k) use ($needle) {
            return $k === $needle;
        }, ARRAY_FILTER_USE_KEY);

        if (count($result) == null)
            throw new ViewException("`$needle` never added");

        return current($result);
    }

    private function isKey($string)
    {
        return strpos("$", $string) !== false;
    }

    private function getKey($string)
    {
        $exp = explode(".", $string);

        if ($this->isKey($string))
            return substr($string, 1);
        else if (count($exp) > 1)
            return $exp[0];

        return $string;
    }

    private function hasProperty($string)
    {
        return count(explode(".", $string)) > 1;
    }

    private function getProperty($string)
    {
        return explode(".", $string)[1];
    }

    private function import(&$document, $iterationData)
    {
        $tags = $document->getElementsByTagName("import");

        for ($i = 0; $i < $tags->length; $i++) {
            $element = $tags->item($i);
            $attr = null;

            foreach ($element->attributes as $a) {

                if ($a->name == "var") {
                    $attr = $a;
                    break;
                }
            }

            if ($attr === null) {
                $error = $this->DOM->createElement('h1', "Error: Invalid parameters on <import> (Line: " . $element->getLineNo() . ")");
                $element->appendChild($error);
                return;
            }

            if ($attr->value == "$")
                $value = $iterationData;
            else if ($this->isKey($attr->value))
                $value = $iterationData[$this->getKey($attr->value)];
            else if (substr($attr->value, 0, 1) == "#")
                $value = substr($attr->value, 1);
            else
                $value = $this->searchData($attr->value);

            if (is_array($value))
                $value = $value[$this->getProperty($attr->value)];


            $doc = $this->loadHTML($value);
            $doc = $this->parse($doc);

            $body = $doc->getElementsByTagName("body")->item(0);
            foreach ($body->childNodes as $node)
            {
                $newNode = $document->importNode($node, true);
                $element->parentNode->insertBefore($newNode, $element);
            }

            $element->parentNode->removeChild($element);
            $i--;

        }

    }

    private function iterator(&$document, $iterationData)
    {
        $tags = $document->getElementsByTagName("iterator");

        for ($i = 0; $i < $tags->length; $i++) {
            $element = $tags->item($i);
            $attr = null;

            foreach ($element->attributes as $a) {
                if ($a->name == "var") {
                    $attr = $a;
                    break;
                }
            }

            if ($attr === null) {
                $error = $this->DOM->createElement('h1', "Error: Invalid parameters on <iterator> (Line: " . $element->getLineNo() . ")");
                $element->appendChild($error);
                return;
            }

            if ($attr->value == "$")
                $value = $iterationData;
            else if ($this->isKey($attr->value))
                $value = $iterationData[$this->getKey($attr->value)];
            else
                $value = $this->searchData($this->getKey($attr->value));

            if (count(explode(".", $attr->value)) > 1)
                $value = $value[$this->getProperty($attr->value)];

            $clones = array();

            $parent = null;

            foreach ($element->childNodes as $node) {
                if (property_exists($node, "tagName")) {
                    $parent = $node;
                    break;
                }
            }

            for ($x = 0; $x < count($value); $x++) {
                $clone = $parent->cloneNode(true);
                array_push($clones, $clone);
            }

            $element->removeChild($parent);

            foreach ($clones as $clone) {
                $element->ownerDocument->importNode($clone);
                $element->appendChild($clone);
            }

            while ($element->firstChild)
                $element->parentNode->insertBefore($element->firstChild, $element);

            $element->parentNode->removeChild($element);
            $i--;

            $x = 0;
            foreach ($value as $v) {
                $this->parse($clones[$x], $v);
                $x++;
            }

        }
    }

    private function conditional(&$document, $iterationData)
    {
        $tags = $document->getElementsByTagName("conditional");

        for ($i = 0; $i < $tags->length; $i++) {
            $element = $tags->item($i);
            $attr = null;

            foreach ($element->attributes as $a) {
                if ($a->name == "var") {
                    $attr = $a;
                    break;
                }
            }

            if ($attr === null) {
                $error = $this->DOM->createElement('h1', "Error: Invalid parameters on <conditional> (Line: " . $element->getLineNo() . ")");
                $element->appendChild($error);
                return null;
            }

            if ($attr->value == "$") {
                if ($iterationData === null)
                    return null;
                $value = $iterationData;
            } else if ($this->isKey($attr->value))
                $value = $iterationData[$this->getKey($attr->value)];
            else
                $value = $this->searchData($this->getKey($attr->value));


            if (is_array($value))
                $value = $value[$this->getProperty($attr->value)];

            if ($value === true) {
                if (!$element->hasChildNodes()) {
                    $error = $this->DOM->createElement('h1', "Error: Conditional without child node (Line: " . $element->getLineNo() . ")");
                    $element->appendChild($error);
                    return null;
                }

                while ($element->firstChild) {
                    $element->parentNode->insertBefore($element->firstChild, $element);
                }
            }
            $element->parentNode->removeChild($element);
            $i--;
        }

        return false;
    }

    private function text(&$document, $iterationData)
    {
        $tags = $document->getElementsByTagName("text");

        for ($i = 0; $i < $tags->length; $i++) {
            $element = $tags->item($i);
            $attr = null;

            foreach ($element->attributes as $a) {
                if ($a->name == "var") {
                    $attr = $a;
                    break;
                }
            }

            if ($attr === null) {
                $error = $this->DOM->createElement('h1', "Error: Invalid parameters on <text> (Line: " . $element->getLineNo() . ")");
                $element->appendChild($error);
                return null;
            }

            $value = null;

            if ($attr->value == "$")
                $value = $iterationData;
            else if ($this->isKey($attr->value))
                $value = $iterationData[$this->getKey($attr->value)];
            else
                $value = $this->searchData($this->getKey($attr->value));

            if (is_array($value) && $this->hasProperty($attr->value))
                $value = $value[$this->getProperty($attr->value)];

            if (is_array($value))
                $value = "{{ARRAY}}";

            if ($value != null) {
                $textNode = $this->DOM->createTextNode($value);
                $newNode = $this->DOM->importNode($textNode);
                $element->parentNode->replaceChild($newNode, $element);
                $i--;
            }
        }
    }

    private function parse($document = null, $iterationData = null)
    {
        if ($document === null) $document = $this->DOM;

        if ($iterationData !== null)
            $this->iterator($document, $iterationData);


        $this->conditional($document, $iterationData);
        $this->import($document, $iterationData);
        $this->text($document, $iterationData);

        if ($iterationData === null)
            $this->iterator($document, $iterationData);

        return $document;
    }

    public function show()
    {
        $this->parse();
        return $this->DOM->saveHTML();
    }

    private function addData($name, $data)
    {
        $this->data[$name] = $data;
    }

    private function addArray($name, $array)
    {
        $data = array();
        foreach ($array as $k => $d) {
            $data[$k] = $d;
        }

        $this->data[$name] = $data;

    }

    public function add($alias, $data)
    {
        if (is_object($data))
            $this->addArray($alias, (array)$data);
        else if (is_array($data)) {
            if (is_object($this->array_first($data)))
                array_map(function ($d) {
                    return (array)$d;
                }, $data);

            $this->addArray($alias, $data);
        } else
            $this->addData($alias, $data);

        return $this;
    }
}
