# Este modulo foi criado utilizando como base: https://github.com/henricavalcante/openomr 


Modulo PHP para leitura de marca��es em documentos(imagens).
============================================================
[![Build Status](https://travis-ci.org/henricavalcante/openomr.svg?branch=master)](https://travis-ci.org/henricavalcante/openomr)

Descri��o
---------
O Modulo OMR_leitura_gabarito em PHP � um conjunto de classes de dom�nio que facilitam, para o desenvolvedor, a utiliza��o das funcionalidades que openomr oferece para detectar marca��es em uma imagem utilizando optical mark recognition (OMR).

Requisitos
----------

 - [PHP] 5.4+
 - extens�o imagick

Instala��o
----------
 - Baixe o reposit�rio como arquivo zip ou fa�a um clone;
 - Descompacte os arquivos em seu computador;
 - Na raiz existe o diret�rio  *examples* que cont�m exemplos de utiliza��o.

 Instala��o via Composer
 - ainda n�o implementada


Configura��o
------------
No maximo alterar a constante DOMAIN_PATH_OMR constante no arquivo constants.php na raiz do modulo. Caso clone utilizando o mesmo nome, somente os *Requisitos* j� citados s�o necess�rios.


Contribui��es
-------------

Achou e corrigiu um bug ou tem alguma feature em mente e deseja contribuir?

* Fa�a um fork
* Adicione sua feature ou corre��o de bug (git checkout -b my-new-feature)
* Commit suas mudan�as (git commit -am 'Added some feature')
* Rode um push para o branch (git push origin my-new-feature)
* Envie um Pull Request
* Obs.: Adicione exemplos para sua nova feature. Se seu Pull Request for relacionado a uma vers�o espec�fica, o Pull Request n�o deve ser enviado para o branch master e sim para o branch correspondente a vers�o.

Fluxo do modulo
-------------
A leitura foi realizada de duas formas, para ambas voc� precisar� do include das classes PaperSheet, Field, Mark, Reader.

1) A forma mais simples, onde temos o exemplo do Henri Cavalcante no diretorio examples/procedural_example.php.
� criada uma instancia de PaperSheet com as propor��es do papel escaneado para gerar uma matriz e realizar� loops percorrendo os pontos desta matriz criando Field com Marks para serem adicionados ao seu objeto PaperSheet.
Uma vez criado e populado seu objeto PaperSheet, utiliza o Reader para devolver um array com os pontos encontrados na imagem.

2) A segunda forma (diretorio examples/oo_example.php) voc� precisar� de dois objetos adicionais. o LayoutORM e o FileReaderOMR.
Neste caso voc� instanciara o layout desejado e passara como parametro para o FileReaderOMR que ira ler todos os arquivos do diretorio images e obter suas informa��es de pontos encontrados.
Opcionalmente � possivel criar um arquivo de texto com as respostas de todos os arquivos lidos e salvar no diretorio readings para consulta posterior(voc� tamb�m pode realiza o download utilizando o helper forceDownloadFile).
Opcionalmente � possivel solicitar o array resultante da leitura dos gabaritos atrav�s do metodo getReadings(). Este tamb�m aceita um booleano como parametro para imprimir em formato Json.

Coisas ainda a fazer:
-------------
>> TORNAR VIAVEL ACESSAR COMO API ENVIANDO ARQUIVOS ZIP PARA SEREM PROCESSADOS.
>> IMPLEMENTAR CLASSE PARA EXTRAIR ARQUIVOS DO ZIP PARA O FILE_READER_OMR PODER ACESSAR.
>> VERIFICAR LEITURA DE IMAGENS TORTAS(SE FUNCIONA OU N�O E CASO NEGATIVO CORRIGIR).
>> CRIAR OBRIGATORIEDADE DE EXISTENCIA DO GABARITO OFICIAL.
>> CRIAR SEPARACAO DE LEITURA DO GABARITO OFICIAL DA JA EXISTENTE DOS GABARITOS DE RESPOSTA.
>> INSERIR AS RESPOSTAS DO GABARITO OFICIAL COMO PRIMEIRA LINHA DO ARQUIVO TEXTO.