# Este modulo foi criado utilizando como base: https://github.com/henricavalcante/openomr 


Modulo PHP para leitura de marcações em documentos(imagens).
============================================================
[![Build Status](https://travis-ci.org/henricavalcante/openomr.svg?branch=master)](https://travis-ci.org/henricavalcante/openomr)

Descrição
---------
O Modulo OMR_leitura_gabarito em PHP é um conjunto de classes de domínio que facilitam, para o desenvolvedor, a utilização das funcionalidades que openomr oferece para detectar marcações em uma imagem utilizando optical mark recognition (OMR).

Requisitos
----------

 - [PHP] 5.4+
 - extensão imagick

Instalação
----------
 - Baixe o repositório como arquivo zip ou faça um clone;
 - Descompacte os arquivos em seu computador;
 - Na raiz existe o diretório  *examples* que contém exemplos de utilização.

 Instalação via Composer
 - ainda não implementada


Configuração
------------
No maximo alterar a constante DOMAIN_PATH_OMR constante no arquivo constants.php na raiz do modulo. Caso clone utilizando o mesmo nome, somente os *Requisitos* já citados são necessários.


Contribuições
-------------

Achou e corrigiu um bug ou tem alguma feature em mente e deseja contribuir?

* Faça um fork
* Adicione sua feature ou correção de bug (git checkout -b my-new-feature)
* Commit suas mudanças (git commit -am 'Added some feature')
* Rode um push para o branch (git push origin my-new-feature)
* Envie um Pull Request
* Obs.: Adicione exemplos para sua nova feature. Se seu Pull Request for relacionado a uma versão específica, o Pull Request não deve ser enviado para o branch master e sim para o branch correspondente a versão.

Fluxo do modulo
-------------
A leitura foi realizada de duas formas, para ambas você precisará do include das classes PaperSheet, Field, Mark, Reader.

1) A forma mais simples, onde temos o exemplo do Henri Cavalcante no diretorio examples/procedural_example.php.
É criada uma instancia de PaperSheet com as proporções do papel escaneado para gerar uma matriz e realizará loops percorrendo os pontos desta matriz criando Field com Marks para serem adicionados ao seu objeto PaperSheet.
Uma vez criado e populado seu objeto PaperSheet, utiliza o Reader para devolver um array com os pontos encontrados na imagem.

2) A segunda forma (diretorio examples/oo_example.php) você precisará de dois objetos adicionais. o LayoutORM e o FileReaderOMR.
Neste caso você instanciara o layout desejado e passara como parametro para o FileReaderOMR que ira ler todos os arquivos do diretorio images e obter suas informações de pontos encontrados.
Opcionalmente é possivel criar um arquivo de texto com as respostas de todos os arquivos lidos e salvar no diretorio readings para consulta posterior(você também pode realiza o download utilizando o helper forceDownloadFile).
Opcionalmente é possivel solicitar o array resultante da leitura dos gabaritos através do metodo getReadings(). Este também aceita um booleano como parametro para imprimir em formato Json.

Coisas ainda a fazer:
-------------
>> TORNAR VIAVEL ACESSAR COMO API ENVIANDO ARQUIVOS ZIP PARA SEREM PROCESSADOS.
>> IMPLEMENTAR CLASSE PARA EXTRAIR ARQUIVOS DO ZIP PARA O FILE_READER_OMR PODER ACESSAR.
>> VERIFICAR LEITURA DE IMAGENS TORTAS(SE FUNCIONA OU NÃO E CASO NEGATIVO CORRIGIR).
>> CRIAR OBRIGATORIEDADE DE EXISTENCIA DO GABARITO OFICIAL.
>> CRIAR SEPARACAO DE LEITURA DO GABARITO OFICIAL DA JA EXISTENTE DOS GABARITOS DE RESPOSTA.
>> INSERIR AS RESPOSTAS DO GABARITO OFICIAL COMO PRIMEIRA LINHA DO ARQUIVO TEXTO.