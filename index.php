<?php
class TagRemover
{
    public $htmlFile;
    public $dom;

    // при создании класса создаем DOMDocument из переданного файла
    public function __construct($htmlFile)
    {
        $this->htmlFile = $htmlFile;
        $this->getDom();
    }
    // метод для создания DOMDocument 
    private function getDom()
    {
        $this->dom = new DOMDocument();
        $this->dom->loadHTMLFile($this->htmlFile);
        $this->dom->saveHTML();
    }
    // метод для удаления элемента по параметрам - тег, атрибут, значение атрибута
    public function removeByTagNameAttribute(string $tag, string $tagAttributeName, string $tagAttributeNameValue)
    {
        $nodes = $this->dom->getElementsByTagName($tag);
        foreach ($nodes as $node) {
            if ($node->getAttribute($tagAttributeName) == $tagAttributeNameValue) {
                $node->parentNode->removeChild($node);
            }
            $this->dom->saveHTML();
        }
    }
    // метод для удаления элемента по тегу
    public function removeByTag(string $tag)
    {
        $nodes = $this->dom->getElementsByTagName($tag);
        foreach ($nodes as $node) {
            $node->parentNode->removeChild($node);
        }
        $this->dom->saveHTML();
    }
}

$remover = new TagRemover('index.html');

$remover->removeByTagNameAttribute('meta', 'name', 'keywords');
$remover->removeByTagNameAttribute('meta', 'name', 'description');
$remover->removeByTag('title');