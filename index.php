<?php
error_reporting(0);

$tokenizador = mt_rand();
$tokenuser = md5($tokenizador);
$randomBytes = random_bytes(256);
$base64Value = base64_encode($randomBytes);
$username = "FREE";
$expira = "MEIA NOITE";
?>
<script type="text/javascript">
	var custo = "0";
	var descricao_chk = "CHECKMATE PAYPAL";
	var audio = new Audio('live.mp3');
</script>
<!DOCTYPE html>
<html>
<head>
	<title>CHECKMATE PAYPAL | @Xines1945</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<!-- fontawesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
	<!-- toastr -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	<style type="text/css">
		.nav-tabs{
			background-color:#232b4a;
		}
		.nav-tabs li a{
			color: #fff;
		}
		.tab-content{
			background-color:#0d0e24;
			color:#fff;
			padding:5px
		}
		.nav-tabs > li > a{
			border: medium none;
		}
		.nav-tabs > li > a:hover{
			background-color: #0d0e24 !important;
			border: medium none;
			border-radius: 0;
			color:#fff;
		}
		.active {
			background-color: #0d0e24 !important;
		}
		textarea{
			background: #232b4a;
			color: #fff;
			border: none;
			width: 100%;
			border: none;
			padding: 10px;
			resize: none;
		}
		textarea:focus{
			box-shadow: 0 0 0 0;
			border: 0 none;
			outline: 0;
		}
		button {
			padding: 10px 20px;
			background-color: #4CAF50;
			color: white;
			border: none;
			cursor: pointer;
			border-radius: 5px;
		}
		button:hover {
			background-color: #45a049;
		}
		.stats-container {
			background: #232b4a;
			padding: 15px;
			border-radius: 5px;
			margin-bottom: 15px;
		}
		.stats-item {
			display: inline-block;
			margin-right: 15px;
			font-weight: bold;
		}
		.badge-success { background-color: #28a745 !important; }
		.badge-danger { background-color: #dc3545 !important; }
		.badge-warning { background-color: #ffc107 !important; color: #000 !important; }
		.badge-info { background-color: #17a2b8 !important; }
		.badge-secondary { background-color: #6c757d !important; }
		.threads-badge {
			background: linear-gradient(45deg, #FF6B6B, #4ECDC4) !important;
			font-size: 12px;
			padding: 5px 10px;
		}
		.telegram-link {
			color: #0088cc;
			text-decoration: none;
			font-weight: bold;
		}
		.telegram-link:hover {
			color: #0088cc;
			text-decoration: underline;
		}
	</style>
</head>
<body style="background: #14192e;" class="p-3">
    
    <input type="hidden" value="<?php echo $base64Value; ?>" name="token_api" id="token_api">
    
	<div class="container p-0">
		<a href="../../" class="btn btn-dark shadow" style="background: #0d0e24;"><i class="fas fa-sign-out-alt"></i> Voltar</a>
	</div>
	<div class="container text-white rounded shadow p-3 my-4" style="background: #232b4a;">
		<!-- descrição -->
		<div class="container-fluid">
			<h3><i class="fas fa-chess-queen"></i> CHECKMATE PAYPAL ♟️</h3>
			<span><b>Usuário: <?php echo $username; ?> | Expira em: <?php echo $expira; ?></b></span>
			<br>
			<small class="text-warning"><i class="fas fa-exclamation-triangle"></i> <strong>LIMITE: 500 linhas por verificação</strong></small>
			<br>
			<small class="text-success"><i class="fas fa-bolt"></i> <strong>MULTI-THREADS ATIVO (4 threads simultâneas)</strong></small>
		</div>
		<!-- botoes de ação -->
		<div class="container-fluid mt-3">
			<div class="buttons">
				<button class="btn btn-dark" style="background: #0d0e24;" id="chk-start"><i class="fas fa-play"></i> Iniciar</button>
				<button class="btn btn-dark" style="background: #0d0e24;" id="chk-pause" disabled><i class="fas fa-pause"></i> Pausar</button>
				<button class="btn btn-dark" style="background: #0d0e24;" id="chk-stop" disabled><i class="fas fa-stop"></i> Parar</button>
				<button class="btn btn-dark" style="background: #0d0e24;" id="chk-clean"><i class="fas fa-trash-alt"></i> Limpar</button>
			</div>
		</div>
		<!-- status do checker -->
		<div class="container-fluid mt-3">
			<span class="badge badge-warning" id="estatus">Aguardando inicio...</span>
			<span class="badge threads-badge ml-2" id="threads-status"><i class="fas fa-microchip"></i> Threads: 0/4</span>
		</div>
	</div>

	<!-- tabs -->
	<div class="container p-0 shadow">
		<ul class="nav nav-tabs" id="myTab" role="tablist" style="border: none;">
			<li class="nav-item">
				<a class="nav-link active" style="border: none;" id="home-tab" data-toggle="tab" href="#chk-home" role="tab" aria-controls="home" aria-selected="true"><i class="far fa-credit-card" style="color: #fff;"></i></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" style="border: none;" id="profile-tab" data-toggle="tab" href="#chk-lives" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-thumbs-up fa-lg" style="color: #fff;"></i></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" style="border: none;" id="contact-tab" data-toggle="tab" href="#chk-dies" role="tab" aria-controls="contact" aria-selected="false"><i class="fa fa-thumbs-down fa-lg" style="color: #fff;"></i></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" style="border: none;" id="contact-tab" data-toggle="tab" href="#chk-errors" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-times fa-lg" style="color: #fff;"></i></a>
			</li>
		</ul>
		<div class="tab-content" id="myTabContent">
			<!-- HOME DO CHECKER -->
			<div class="tab-pane fade show active px-3 pt-4 pb-3" id="chk-home" role="tabpanel" aria-labelledby="home-tab">
				<div class="stats-container">
					<span class="stats-item">Aprovadas: <span class="val-lives" style="font-weight: bold; color: #28a745;">0</span></span>
					<span class="stats-item">Reprovadas: <span class="val-dies" style="font-weight: bold; color: #dc3545;">0</span></span>
					<span class="stats-item">Errors: <span class="val-errors" style="font-weight: bold; color: #ffc107;">0</span></span>
					<span class="stats-item">Testadas: <span class="val-tested" style="font-weight: bold; color: #17a2b8;">0</span></span>
					<span class="stats-item">Total: <span class="val-total" style="font-weight: bold; color: #6f42c1;">0</span></span>
					<span class="stats-item">Velocidade: <span class="val-speed" style="font-weight: bold; color: #20c997;">0/min</span></span>
				</div>
				<div class="container-fluid p-0 mt-2">
					<textarea id="lista_cartoes" placeholder="Insira sua lista no formato: CC|MES|ANO|CVV (Máximo 500 linhas)" rows="10" cols="rounded shadow"></textarea>
					<small class="text-warning" id="contador-linhas">Linhas: 0/500</small>
				</div>
			</div>
			
			<script>
			function apagarValoresLives() {
				var tabela = document.getElementById("lives");
				tabela.innerHTML = "";
			}
			</script>
			
			<!-- LIVES DO CHECKERS -->
			<div class="tab-pane fade show px-3 pt-4 pb-3" id="chk-lives" role="tabpanel" aria-labelledby="home-tab">
				<h5>Aprovadas</h5>
				<span>Total: <span class="val-lives">0</span></span>
				<br>
				<button class="btn btn-dark" style="background: #0d0e24;" id="copyButton"><i class="fas fa-copy"></i> Copiar</button>
				<button class="btn btn-dark" style="background: #0d0e24;" onclick="apagarValoresLives()"><i class="fas fa-trash-alt"></i> Limpar</button>
				<br><br>
				<div id="lives" style="overflow:auto; max-height: 400px; background: #14192e; padding: 10px; border-radius: 5px;">
				</div>
			</div>
			
			<script>
			const copyButton = document.getElementById('copyButton');
			const livesDiv = document.getElementById('lives');

			copyButton.addEventListener('click', () => {
				const range = document.createRange();
				range.selectNode(livesDiv);
				window.getSelection().removeAllRanges();
				window.getSelection().addRange(range);

				try {
					const successful = document.execCommand('copy');
					if(successful) {
						toastr["success"]("Copiado para a área de transferência!");
					}
				} catch (err) {
					console.error('Erro ao copiar: ', err);
				}

				window.getSelection().removeAllRanges();
			});
			</script>
			
			<script>
			function apagarValoresDies() {
				var tabela = document.getElementById("dies");
				tabela.innerHTML = "";
			}
			</script>

			<script>
			function apagarValoresErrors() {
				var tabela = document.getElementById("errors");
				tabela.innerHTML = "";
			}
			</script>
			
			<!-- DIES DO CHECKER -->
			<div class="tab-pane fade show px-3 pt-4 pb-3" id="chk-dies" role="tabpanel" aria-labelledby="home-tab">
				<h5>Reprovadas</h5>
				<span>Total: <span class="val-dies">0</span></span>
				<br>
				<button class="btn btn-dark" style="background: #0d0e24;" onclick="apagarValoresDies()"><i class="fas fa-trash-alt"></i> Limpar</button>
				<br><br>
				<div id="dies" style="overflow:auto; max-height: 400px; background: #14192e; padding: 10px; border-radius: 5px;">
				</div>
			</div>
			<!-- ERRORS DO CHECKER -->
			<div class="tab-pane fade show px-3 pt-4 pb-3" id="chk-errors" role="tabpanel" aria-labelledby="home-tab">
				<h5>Erros</h5>
				<span>Total: <span class="val-errors">0</span></span>
				<br>
				<button class="btn btn-dark" style="background: #0d0e24;" onclick="apagarValoresErrors()"><i class="fas fa-trash-alt"></i> Limpar</button>
				<br><br>
				<div id="errors" style="overflow:auto; max-height: 400px; background: #14192e; padding: 10px; border-radius: 5px;">
				</div>
			</div>
		</div>	
	</div>

	<!-- Footer -->
	<div class="container text-center text-white mt-4">
		<small>Checker desenvolvido por <a href="https://t.me/xines1945" class="telegram-link" target="_blank">@Xines1945</a></small>
	</div>

	<!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- bootstrap -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
	<!-- toastr -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	
	<script type="text/javascript">
		// Configuração do Toastr
		toastr.options = {
			"closeButton": true,
			"debug": false,
			"newestOnTop": true,
			"progressBar": true,
			"positionClass": "toast-top-right",
			"preventDuplicates": false,
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		};

		// Função para contar linhas e limitar a 500
		function contarLinhas() {
			var textarea = document.getElementById('lista_cartoes');
			var linhas = textarea.value.split('\n').filter(function(line) {
				return line.trim() !== '';
			});
			var contador = document.getElementById('contador-linhas');
			
			if (linhas.length > 500) {
				// Limita para 500 linhas
				var linhasLimitadas = linhas.slice(0, 500);
				textarea.value = linhasLimitadas.join('\n');
				contador.innerHTML = 'Linhas: <span class="text-danger">500/500 (LIMITE ATINGIDO)</span>';
				toastr["warning"]("Limite de 500 linhas atingido! As linhas extras foram removidas.");
			} else {
				contador.innerHTML = 'Linhas: ' + linhas.length + '/500';
				if (linhas.length === 500) {
					contador.innerHTML = 'Linhas: <span class="text-warning">500/500 (MÁXIMO)</span>';
				}
			}
		}

		$(document).ready(function() {
			// variaveis de informação
			var testadas = [];
			var total = 0;
			var tested = 0;
			var lives = 0;
			var dies = 0;
			var errors = 0;
			var stopped = true;
			var paused = true;
			var token_api = document.getElementById("token_api").value;
			var isTesting = false;
			var activeThreads = 0;
			var maxThreads = 4;
			var startTime = 0;
			var lastUpdateTime = 0;
			var cardsPerMinute = 0;
			var currentList = []; // ARMAZENA A LISTA ORIGINAL
			var currentIndex = 0; // CONTROLA A POSIÇÃO ATUAL

			// Contador de linhas em tempo real
			$('#lista_cartoes').on('input', function() {
				contarLinhas();
			});

			// Função para atualizar velocidade
			function updateSpeed() {
				var now = Date.now();
				var elapsedMinutes = (now - startTime) / 60000;
				if (elapsedMinutes > 0) {
					cardsPerMinute = Math.round(tested / elapsedMinutes);
					$(".val-speed").text(cardsPerMinute + "/min");
				}
				lastUpdateTime = now;
			}

			function updateListVisual() {
				// Cria uma nova lista apenas com os itens que ainda não foram testados
				var remainingList = currentList.slice(currentIndex);
				$("#lista_cartoes").val(remainingList.join("\n"));
				contarLinhas();
			}

			function testarMulti() {
				// verifica se nao está parado o checker
				if (stopped === true) {
					isTesting = false;
					activeThreads = 0;
					updateThreadsStatus();
					return false;
				}

				// verifica se nao está pausado o checker
				if (paused === true) {
					return false;
				}

				// verifica se ja terminou de testar
				if (currentIndex >= total) {
					// Aguarda threads ativas terminarem
					if (activeThreads > 0) {
						setTimeout(function() {
							testarMulti();
						}, 100);
						return;
					}
					
					console.log('finalizado ' + tested + " de " + total);
					$("#estatus").removeClass().addClass("badge badge-success").text("Teste finalizado");
					toastr["success"]("Teste de " + total + " itens finalizado");
					$("#chk-start").removeAttr('disabled');
					$("#chk-clean").removeAttr('disabled');
					$("#chk-stop").attr("disabled", "true");
					$("#chk-pause").attr("disabled", "true");
					stopped = true;
					paused = true;
					isTesting = false;
					activeThreads = 0;
					updateThreadsStatus();
					return false;
				}

				// Inicia múltiplas threads simultaneamente
				var threadsToStart = Math.min(maxThreads - activeThreads, total - currentIndex);
				
				for (var i = 0; i < threadsToStart; i++) {
					if (currentIndex < total) {
						startThread(currentIndex);
						currentIndex++; // INCREMENTA O ÍNDICE IMEDIATAMENTE
					}
				}
			}

			function startThread(index) {
				// verifica se nao está parado o checker
				if (stopped === true) {
					return false;
				}

				// verifica se nao está pausado o checker
				if (paused === true) {
					return false;
				}

				var conteudo = currentList[index];
				
				// Verifica se a linha não está vazia
				if (!conteudo || conteudo.trim() === '') {
					// Pula linha vazia e inicia próxima thread
					setTimeout(function() {
						tested++;
						testarMulti();
					}, 10);
					return;
				}

				console.log("Thread " + (activeThreads + 1) + " testando: " + conteudo + " | Index: " + index);
				activeThreads++;
				updateThreadsStatus();
				isTesting = true;

				$.ajax({
					url: 'api.php',
					type: 'POST',
					data: { 
						lista: conteudo
					},
					timeout: 30000,
					beforeSend: function() {
						$("#estatus").removeClass().addClass("badge badge-info").text("Threads ativas: " + activeThreads + " | Testando...");
					}
				})
				.done(function(response) {
					// verifica se nao está parado o checker
					if (stopped === true) {
						activeThreads--;
						updateThreadsStatus();
						return false;
					}

					// verifica se nao está pausado o checker
					if (paused === true) {
						activeThreads--;
						updateThreadsStatus();
						return false;
					}

					tested++;
					activeThreads--;
					updateThreadsStatus();

					// Limpa a resposta
					response = response.trim();

					// Atualiza velocidade
					updateSpeed();

					console.log("Resposta thread: " + response);
					
					// **DETECÇÃO PERFEITA BASEADA NA SUA API**
					var responseUpper = response.toUpperCase();

					// Extrai os dados do cartão para formatação
					var cardData = conteudo.split('|');
					var cc = cardData[0] || '';
					var mes = cardData[1] || '';
					var ano = cardData[2] || '';
					var cvv = cardData[3] || '';

					// Encontra o código de retorno na resposta
					var retornoCode = 'UNKNOWN';
					if (responseUpper.indexOf("INVALID_SECURITY_CODE") >= 0) retornoCode = "INVALID_SECURITY_CODE";
					else if (responseUpper.indexOf("EXISTING_ACCOUNT_RESTRICTED") >= 0) retornoCode = "EXISTING_ACCOUNT_RESTRICTED";
					else if (responseUpper.indexOf("INVALID_BILLING_ADDRESS") >= 0) retornoCode = "INVALID_BILLING_ADDRESS";
					else if (responseUpper.indexOf("SUCCESS") >= 0) retornoCode = "SUCCESS";
					else if (responseUpper.indexOf("GENERIC_CARD_ERROR") >= 0) retornoCode = "GENERIC_CARD_ERROR";
					else if (responseUpper.indexOf("OAS_VALIDATION") >= 0) retornoCode = "OAS_VALIDATION";
					else if (responseUpper.indexOf("VALIDATION_ERROR") >= 0) retornoCode = "VALIDATION_ERROR";
					else if (responseUpper.indexOf("CARD_GENERIC_ERROR") >= 0) retornoCode = "CARD_GENERIC_ERROR";
					else if (responseUpper.indexOf("R_ERROR") >= 0) retornoCode = "R_ERROR";
					else if (responseUpper.indexOf("DECLINED") >= 0) retornoCode = "DECLINED";
					else if (responseUpper.indexOf("APPROVED") >= 0) retornoCode = "APPROVED";

					// Encontra o tempo na resposta (se disponível)
					var tempoMatch = response.match(/Tempo:\s*\((\d+)s\)/);
					var tempo = tempoMatch ? tempoMatch[1] + "s" : "0s";

					// **APROVADAS - Baseado nas respostas da sua API**
					if (responseUpper.indexOf("APROVADA") >= 0 || 
						responseUpper.indexOf("APPROVED") >= 0 || 
						responseUpper.indexOf("EXISTING_ACCOUNT_RESTRICTED") >= 0 ||
						responseUpper.indexOf("INVALID_SECURITY_CODE") >= 0 ||
						responseUpper.indexOf("INVALID_BILLING_ADDRESS") >= 0 ||
						responseUpper.indexOf("SUCCESS") >= 0) {
						lives++;
						$("#estatus").removeClass().addClass("badge badge-success").text("APROVADA! Threads: " + activeThreads);
						toastr["success"]("Aprovada! " + conteudo);
						
						// Formatação personalizada para APROVADAS
						var formattedResponse = cc + "|" + mes + "|" + ano + "|" + cvv + "<br>";
						formattedResponse += "<b>Retorno: <span class='text-success'>" + retornoCode + "</span></b>";
						formattedResponse += " <b>Tempo: (" + tempo + ") » CHECKMATE ♟️</b>";
						
						$("#lives").prepend("<span class='text-success'>" + formattedResponse + "</span><br><br>");
						if (audio) {
							audio.play().catch(function(e) {
								console.log("Erro ao reproduzir áudio: ", e);
							});
						}
					} 
					// **REPROVADAS - Baseado nas respostas da sua API**
					else if (responseUpper.indexOf("REPROVADA") >= 0 ||
							 responseUpper.indexOf("DECLINED") >= 0 || 
							 responseUpper.indexOf("GENERIC_CARD_ERROR") >= 0 ||
							 responseUpper.indexOf("OAS_VALIDATION") >= 0 ||
							 responseUpper.indexOf("VALIDATION_ERROR") >= 0 ||
							 responseUpper.indexOf("CARD_GENERIC_ERROR") >= 0 ||
							 responseUpper.indexOf("R_ERROR") >= 0) {
						dies++;
						$("#estatus").removeClass().addClass("badge badge-danger").text("REPROVADA! Threads: " + activeThreads);
						toastr["error"]("Reprovada! " + conteudo);
						
						// Formatação personalizada para REPROVADAS
						var formattedResponse = cc + "|" + mes + "|" + ano + "|" + cvv + "<br>";
						formattedResponse += "<b>Retorno: <span class='text-danger'>" + retornoCode + "</span></b>";
						formattedResponse += " <b>Tempo: (" + tempo + ") » CHECKMATE ♟️</b>";
						
						$("#dies").prepend("<span class='text-danger'>" + formattedResponse + "</span><br><br>");
					} 
					// **ERROS - Qualquer outra resposta vai para ERROS**
					else {
						errors++;
						$("#estatus").removeClass().addClass("badge badge-warning").text("ERROR! Threads: " + activeThreads);
						toastr["warning"]("Ocorreu um erro! " + conteudo);
						
						// Formatação personalizada para ERROS
						var formattedResponse = cc + "|" + mes + "|" + ano + "|" + cvv + "<br>";
						formattedResponse += "<b>Retorno: <span class='text-warning'>" + retornoCode + "</span></b>";
						formattedResponse += " <b>Tempo: (" + tempo + ") » CHECKMATE ♟️</b>";
						
						$("#errors").prepend("<span class='text-warning'>" + formattedResponse + "</span><br><br>");
					}

					// atualiza resultados
					$(".val-total").text(total);
					$(".val-lives").text(lives);
					$(".val-dies").text(dies);
					$(".val-errors").text(errors);
					$(".val-tested").text(tested);

					// Atualiza visualmente a lista removendo o item testado
					updateListVisual();

					// Inicia próxima thread
					setTimeout(function() {
						testarMulti();
					}, 50);

				})
				.fail(function(xhr, status, error) {
					// verifica se nao está parado o checker
					if (stopped === true) {
						activeThreads--;
						updateThreadsStatus();
						return false;
					}

					// verifica se nao está pausado o checker
					if (paused === true) {
						activeThreads--;
						updateThreadsStatus();
						return false;
					}

					errors++;
					tested++;
					activeThreads--;
					updateThreadsStatus();
					
					$(".val-errors").text(errors);
					$(".val-tested").text(tested);
					
					var errorMsg = "ERRO: ";
					if (status === "timeout") {
						errorMsg += "Timeout";
					} else {
						errorMsg += error;
					}
					
					$("#estatus").removeClass().addClass("badge badge-danger").text("ERRO THREAD! Threads: " + activeThreads);
					toastr["error"](errorMsg);
					
					// Formatação personalizada para ERROS DE CONEXÃO
					var cardData = conteudo.split('|');
					var cc = cardData[0] || '';
					var mes = cardData[1] || '';
					var ano = cardData[2] || '';
					var cvv = cardData[3] || '';
					
					var formattedResponse = cc + "|" + mes + "|" + ano + "|" + cvv + "<br>";
					formattedResponse += "<b>Retorno: <span class='text-warning'>" + errorMsg + "</span></b>";
					formattedResponse += " <b>Tempo: (Timeout) » CHECKMATE ♟️</b>";
					
					$("#errors").prepend("<span class='text-warning'>" + formattedResponse + "</span><br><br>");
					
					// Atualiza visualmente a lista removendo o item testado
					updateListVisual();
					
					// Inicia próxima thread
					setTimeout(function() {
						testarMulti();
					}, 100);
				});
			}

			function updateThreadsStatus() {
				$("#threads-status").html('<i class="fas fa-microchip"></i> Threads: ' + activeThreads + '/' + maxThreads);
				if (activeThreads === maxThreads) {
					$("#threads-status").addClass("badge-success").removeClass("badge-warning");
				} else if (activeThreads > 0) {
					$("#threads-status").addClass("badge-warning").removeClass("badge-success");
				} else {
					$("#threads-status").removeClass("badge-success badge-warning");
				}
			}

			// ========== START ========== //
			function start() {
				// Previne múltiplos cliques
				if (isTesting) {
					return;
				}

				var lista = $("#lista_cartoes").val().trim().split('\n');
				// Filtra linhas vazias
				lista = lista.filter(function(item) {
					return item.trim() !== '';
				});
				total = lista.length;

				if (total === 0) {
					toastr["warning"]("Insira uma lista válida para verificar!");
					$("#lista_cartoes").focus();
					return;
				}

				// VERIFICA LIMITE DE 500 LINHAS
				if (total > 500) {
					toastr["error"]("Limite de 500 linhas excedido! Remova " + (total - 500) + " linhas.");
					$("#estatus").removeClass().addClass("badge badge-danger").text("Limite de 500 linhas excedido!");
					return;
				}

				// SALVA A LISTA ORIGINAL E RESETA OS ÍNDICES
				currentList = lista.slice(); // COPIA DA LISTA ORIGINAL
				currentIndex = 0;
				tested = 0;

				$(".val-total").text(total);
				stopped = false;
				paused = false;
				isTesting = true;
				startTime = Date.now();
				lastUpdateTime = startTime;
				
				toastr["success"]("Checker Multi-Thread Iniciado com " + total + " cartões!");
				$("#estatus").removeClass().addClass("badge badge-success").text("Multi-Thread iniciado...");

				// Libera os botões
				$("#chk-stop").removeAttr('disabled');
				$("#chk-pause").removeAttr('disabled');
				$("#chk-start").attr("disabled", "true");
				$("#chk-clean").attr("disabled", "true");

				// Reseta contadores se for um novo início
				if (tested === 0) {
					lives = 0;
					dies = 0;
					errors = 0;
					$(".val-lives").text(lives);
					$(".val-dies").text(dies);
					$(".val-errors").text(errors);
					$(".val-speed").text("0/min");
				}

				// Inicia o teste multi-thread
				testarMulti();
			}

			$("#chk-start").click(function() {
				if ($("#lista_cartoes").val().trim() === "") {
					$("#lista_cartoes").focus();
					toastr["warning"]("Insira uma lista para verificar!");
				} else {
					start();
				}
			});

			// ========== PAUSE ========== //
			function pause() {
				$("#chk-start").removeAttr('disabled');
				$("#chk-pause").attr("disabled", "true");
				paused = true;
				console.log('checker pausado');
				toastr["info"]("Checker Pausado!");
				$("#estatus").removeClass().addClass("badge badge-info").text("Checker pausado...");
			}

			$("#chk-pause").click(function() {
				pause();
			});

			// ========== STOP ========== //
			function stop() {
				stopped = true;
				paused = true;
				isTesting = false;
				activeThreads = 0;
				updateThreadsStatus();
				$("#chk-start").removeAttr('disabled');
				$("#chk-clean").removeAttr('disabled');
				$("#chk-stop").attr("disabled", "true");
				$("#chk-pause").attr("disabled", "true");
				console.log('checker parado');
				toastr["info"]("Checker Parado!");
				$("#estatus").removeClass().addClass("badge badge-secondary").text("Checker parado...");
			}

			$("#chk-stop").click(function() {
				stop();
			});

			// ========== CLEAN ========== //
			function clean() {
				// Para o checker se estiver rodando
				stopped = true;
				paused = true;
				isTesting = false;
				activeThreads = 0;
				updateThreadsStatus();
				
				testadas = [];
				total = 0;
				tested = 0;
				lives = 0;
				dies = 0;
				errors = 0;
				currentList = [];
				currentIndex = 0;

				// atualiza resultados
				$(".val-total").text(total);
				$(".val-lives").text(lives);
				$(".val-dies").text(dies);
				$(".val-errors").text(errors);
				$(".val-tested").text(tested);
				$(".val-speed").text("0/min");
				$("#lista_cartoes").val("");
				$("#lives").html("");
				$("#dies").html("");
				$("#errors").html("");
				$("#estatus").removeClass().addClass("badge badge-warning").text("Aguardando inicio...");
				$("#contador-linhas").text("Linhas: 0/500");
				
				// Reseta botões
				$("#chk-start").removeAttr('disabled');
				$("#chk-clean").removeAttr('disabled');
				$("#chk-stop").attr("disabled", "true");
				$("#chk-pause").attr("disabled", "true");
				
				toastr["info"]("Checker Limpo!");
			}

			$("#chk-clean").click(function() {
				clean();
			});

			// Inicializa o contador de linhas
			contarLinhas();
			
			// Garantir que não há chamadas automáticas
			console.log("Checker Multi-Thread carregado - Aguardando comando do usuário");
		});
	</script>

</body>
</html>