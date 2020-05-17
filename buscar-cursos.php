#!/usr/bin/env php
<?php

#Estrutura física de pastas
require 'vendor/autoload.php';

#Estrutura lógica de pastas
#A palavra reservada "use" faz a importação de classes necessárias  
use Alura\BuscadorDeCursos\Buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

#Fazendo requisições no servidor e, 
#obtendo respostas com o componente GuzzleHttp
$client = new Client([
    #O base_uri especifica a url base do site
    'base_uri' => 'https://www.alura.com.br/',
    #A chave verify com o valor false é para não
    #ler o certificado SSL do navegador
    'verify' => false
]);

#Percorrendo os elementos do DOM com o componente DOMCRAWLER
$crawler = new Crawler();

#Minha classe Buscador para percorrer os 2 componentes
$buscador = new Buscador($client, $crawler);

#A partir da url passada na classe client, está fazendo
#requisição nesse recurso do site alura
$cursos = $buscador->buscar('/cursos-online-programacao/php');

#Exibindo o nome dos cursos no browser com
#mudança de linha usando a tag <br> html
foreach ($cursos as $curso) {
    #Abaixo temos essas 2 opções para exibir a quebra de linha
    #echo exibeMensagem("$curso <br>");
    exibeMensagem("$curso . \r\n");

}
