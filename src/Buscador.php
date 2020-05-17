<?php

#Estrutura lógica da pasta src, que no
#caso é a pasta raiz da classe Buscador
#O namespace que é a estrutura lógica de pastas
#patra evitar o conflito de nome, porém, ele também
#está relacionado à estrutura física de pastas que
#no meu caso aqui é a raiz src
namespace Alura\BuscadorDeCursos;

#Importação de classes
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    private $httpClient;
    private $crawler;

    public function __construct(Client $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function buscar(string $url): array
    {
        #Cliente http obtendo resposta
        $resposta = $this->httpClient->request('GET', $url);

        #Corpo do html
        $html = $resposta->getBody();
        
        #String $html sendo parseada através dos elementos html
        $this->crawler->addHtmlContent($html);

        #Percorrendo seletores css, porém percorre também elementos html e xml
        $elementosCursos = $this->crawler->filter('span.card-curso__nome');
        
        #Variável de array's vazia
        #Cada um desses elementos de cursos vão ser atribuidos
        #a um array
        $cursos = [];

        #Percorrendo os seletores css onde estão os nomes dos cursos
        foreach ($elementosCursos as $elemento) {
            #Do elemento de cursos, vai ser retornado somente os
            #nomes dos cursos que serão atribuídos a um array
            $cursos[] = $elemento->textContent;
        }

        #Retornar array de cursos
        return $cursos;
    }
}
