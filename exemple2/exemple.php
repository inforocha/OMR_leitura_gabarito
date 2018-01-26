<?php
require_once '../constants.php';
require_once DOMAIN_PATH_OMR.'src/OpenOMR/PaperSheet/PaperSheet.php';
require_once DOMAIN_PATH_OMR.'src/OpenOMR/PaperSheet/Field.php';
require_once DOMAIN_PATH_OMR.'src/OpenOMR/PaperSheet/Mark.php';
require_once DOMAIN_PATH_OMR.'src/OpenOMR/Reader/Reader.php';

$paper = new PaperSheet(38, 65);

// identificador utilizado para cada questao
$identificadorUnico = 1;
// quantidade de colunas das respostas
$qtdDeColunasRespostas = 6;
// quantidade de respostas em cada coluna
$qtdDeRespostas = 5;
$letrasRespostas = array('A','B','C','D','E');

// distancia entre o ponto inicial e final das questoes
$pontoInicial = 49;
$pontoFinal = 63;
// ponto da numeracao da questao - iremos pular a posicao do numero da questao. Utilizaremos somente os pontos das respostas
$posicaoAtualDaLeitura = 0;

// percorrendo as colunas para pegar as respostas
for ($colunaAtual = 1; $colunaAtual <= $qtdDeColunasRespostas; $colunaAtual++) {
	// o primeiro ponto eh uma questao. pulando ele. Cada iteracao informa que acabaram as respostas. pulando o ponto da questao.
	$posicaoAtualDaLeitura++;

	// percorrendo os pontos na vertical ( eixo y )
	for ($pontoAtual = $pontoInicial; $pontoAtual <= $pontoFinal; $pontoAtual++) {
		// criando a referencia para um campo com id unico. valores de 1 a 9 recebem um zero a esquerda.
		$field = new Field(str_pad($identificadorUnico, 2, '0', STR_PAD_LEFT));

		// percorrendo os pontos na horizontal( eixo x )
		for ($respostaAtual = 0; $respostaAtual < $qtdDeRespostas; $respostaAtual++) { 
			$field->addMark(new Mark($pontoAtual, $posicaoAtualDaLeitura, $letrasRespostas[$respostaAtual]));
		}

		$paper->addField($field);

		$identificadorUnico++;
		// incrementando o ponto da resposta
		$posicaoAtualDaLeitura++;
	}
}

$reader = new Reader('gabarito1.jpeg', $paper, 4);
var_dump($reader->getResults());