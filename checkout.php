<?php require_once 'menu.php'; ?>

<section class="checkout">

	<h1 class="busca-titulo">Finalizar Compra</h1>

	<div id="checkout-vazio" class="busca-vazio" style="display:none;">
		<p>Seu carrinho está vazio.</p>
		<a href="listarjogo.php" class="hero-btn2 carrinho-vazio-btn">Ver jogos</a>
	</div>

	<div id="checkout-conteudo" class="checkout-grid">

		<div class="checkout-principal">

			<div class="checkout-metodos" id="checkout-metodos">
				<button type="button" class="metodo-card ativo" data-metodo="pix">
					<span class="metodo-icone"><img src="img/pagamento/pix.png" alt="Pix"></span>
					<span>Pix</span>
				</button>
				<button type="button" class="metodo-card" data-metodo="credito">
					<span class="metodo-icone"><img src="img/pagamento/cartoes.png" alt="Cartão de Crédito"></span>
					<span>Crédito</span>
				</button>
				<button type="button" class="metodo-card" data-metodo="debito">
					<span class="metodo-icone"><img src="img/pagamento/cartoes.png" alt="Cartão de Débito"></span>
					<span>Débito</span>
				</button>
				<button type="button" class="metodo-card" data-metodo="paypal">
					<span class="metodo-icone"><img src="img/pagamento/paypal.jpg" alt="PayPal"></span>
					<span>PayPal</span>
				</button>
				<button type="button" class="metodo-card" data-metodo="giftcard">
					<span class="metodo-icone"><img src="img/pagamento/giftcard.png" alt="Gift Card"></span>
					<span>Gift Card</span>
				</button>
			</div>

			<!-- PIX -->
			<div class="checkout-formulario" id="form-pix" data-form="pix">
				<div class="pix-caixa">
					<div class="pix-qr" aria-hidden="true">
						<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
							<rect width="100" height="100" fill="#ffffff"/>
							<g fill="#0a0a0d">
								<rect x="6" y="6" width="22" height="22"/>
								<rect x="12" y="12" width="10" height="10" fill="#ffffff"/>
								<rect x="72" y="6" width="22" height="22"/>
								<rect x="78" y="12" width="10" height="10" fill="#ffffff"/>
								<rect x="6" y="72" width="22" height="22"/>
								<rect x="12" y="78" width="10" height="10" fill="#ffffff"/>
								<rect x="34" y="6" width="4" height="4"/><rect x="42" y="6" width="4" height="4"/><rect x="54" y="10" width="4" height="4"/>
								<rect x="34" y="14" width="4" height="4"/><rect x="46" y="18" width="4" height="4"/><rect x="60" y="14" width="4" height="4"/>
								<rect x="38" y="26" width="4" height="4"/><rect x="50" y="26" width="4" height="4"/><rect x="62" y="24" width="4" height="4"/>
								<rect x="34" y="34" width="4" height="4"/><rect x="44" y="34" width="4" height="4"/><rect x="56" y="34" width="4" height="4"/><rect x="66" y="34" width="4" height="4"/>
								<rect x="6" y="34" width="4" height="4"/><rect x="14" y="38" width="4" height="4"/><rect x="22" y="34" width="4" height="4"/>
								<rect x="78" y="38" width="4" height="4"/><rect x="86" y="34" width="4" height="4"/><rect x="90" y="44" width="4" height="4"/>
								<rect x="6" y="46" width="4" height="4"/><rect x="16" y="50" width="4" height="4"/><rect x="24" y="46" width="4" height="4"/>
								<rect x="34" y="46" width="4" height="4"/><rect x="42" y="50" width="4" height="4"/><rect x="50" y="46" width="4" height="4"/><rect x="60" y="50" width="4" height="4"/>
								<rect x="72" y="52" width="4" height="4"/><rect x="80" y="50" width="4" height="4"/><rect x="88" y="56" width="4" height="4"/>
								<rect x="6" y="58" width="4" height="4"/><rect x="16" y="62" width="4" height="4"/><rect x="24" y="58" width="4" height="4"/>
								<rect x="36" y="60" width="4" height="4"/><rect x="46" y="58" width="4" height="4"/><rect x="56" y="62" width="4" height="4"/>
								<rect x="34" y="72" width="4" height="4"/><rect x="42" y="76" width="4" height="4"/><rect x="50" y="72" width="4" height="4"/><rect x="60" y="76" width="4" height="4"/>
								<rect x="70" y="66" width="4" height="4"/><rect x="78" y="70" width="4" height="4"/><rect x="86" y="66" width="4" height="4"/>
								<rect x="34" y="84" width="4" height="4"/><rect x="44" y="88" width="4" height="4"/><rect x="54" y="84" width="4" height="4"/>
								<rect x="64" y="88" width="4" height="4"/><rect x="74" y="84" width="4" height="4"/><rect x="84" y="88" width="4" height="4"/><rect x="90" y="80" width="4" height="4"/>
							</g>
						</svg>
					</div>
					<p class="pix-texto">Escaneie o QR Code com o app do seu banco ou copie o código Pix Copia e Cola abaixo.</p>
					<div class="pix-codigo">
						<input type="text" id="pix-codigo-input" readonly>
						<button type="button" id="pix-copiar">Copiar</button>
					</div>
					<p class="pix-aviso">O pagamento é confirmado automaticamente em alguns instantes após o pagamento.</p>
				</div>
			</div>

			<!-- CARTAO DE CREDITO -->
			<div class="checkout-formulario" id="form-credito" data-form="credito" hidden>
				<div class="cartao-preview" id="cartao-preview-credito">
					<div class="cartao-topo">
						<span class="cartao-chip"></span>
						<span class="cartao-bandeira">CRÉDITO</span>
					</div>
					<div class="cartao-numero" id="preview-numero-credito">•••• •••• •••• ••••</div>
					<div class="cartao-base">
						<span id="preview-nome-credito">NOME NO CARTÃO</span>
						<span id="preview-validade-credito">••/••</span>
					</div>
				</div>
				<div class="campo-linha">
					<label>Número do cartão
						<input type="text" class="cartao-numero-input" data-preview="preview-numero-credito" inputmode="numeric" maxlength="19" placeholder="0000 0000 0000 0000" required>
					</label>
				</div>
				<div class="campo-linha">
					<label>Nome impresso no cartão
						<input type="text" class="cartao-nome-input" data-preview="preview-nome-credito" placeholder="Como está no cartão" required>
					</label>
				</div>
				<div class="campo-grade">
					<label>Validade
						<input type="text" class="cartao-validade-input" data-preview="preview-validade-credito" inputmode="numeric" maxlength="5" placeholder="MM/AA" required>
					</label>
					<label>CVV
						<input type="text" class="cartao-cvv-input" inputmode="numeric" maxlength="4" placeholder="000" required>
					</label>
					<label>Parcelas
						<select id="credito-parcelas"></select>
					</label>
				</div>
			</div>

			<!-- CARTAO DE DEBITO -->
			<div class="checkout-formulario" id="form-debito" data-form="debito" hidden>
				<div class="cartao-preview" id="cartao-preview-debito">
					<div class="cartao-topo">
						<span class="cartao-chip"></span>
						<span class="cartao-bandeira">DÉBITO</span>
					</div>
					<div class="cartao-numero" id="preview-numero-debito">•••• •••• •••• ••••</div>
					<div class="cartao-base">
						<span id="preview-nome-debito">NOME NO CARTÃO</span>
						<span id="preview-validade-debito">••/••</span>
					</div>
				</div>
				<div class="campo-linha">
					<label>Número do cartão
						<input type="text" class="cartao-numero-input" data-preview="preview-numero-debito" inputmode="numeric" maxlength="19" placeholder="0000 0000 0000 0000" required>
					</label>
				</div>
				<div class="campo-linha">
					<label>Nome impresso no cartão
						<input type="text" class="cartao-nome-input" data-preview="preview-nome-debito" placeholder="Como está no cartão" required>
					</label>
				</div>
				<div class="campo-grade campo-grade-2">
					<label>Validade
						<input type="text" class="cartao-validade-input" data-preview="preview-validade-debito" inputmode="numeric" maxlength="5" placeholder="MM/AA" required>
					</label>
					<label>CVV
						<input type="text" class="cartao-cvv-input" inputmode="numeric" maxlength="4" placeholder="000" required>
					</label>
				</div>
				<p class="metodo-aviso">Pagamento à vista, debitado direto da sua conta.</p>
			</div>

			<!-- PAYPAL -->
			<div class="checkout-formulario" id="form-paypal" data-form="paypal" hidden>
				<div class="paypal-caixa">
					<img src="img/pagamento/paypal.jpg" alt="PayPal" class="paypal-logo-img">
					<p class="pix-texto">Você será redirecionado ao PayPal para confirmar o pagamento com sua conta ou cartão vinculado.</p>
					<label class="campo-linha">E-mail da conta PayPal
						<input type="email" id="paypal-email" placeholder="seuemail@exemplo.com" required>
					</label>
				</div>
			</div>

			<!-- GIFT CARD -->
			<div class="checkout-formulario" id="form-giftcard" data-form="giftcard" hidden>
				<div class="giftcard-caixa">
					<p class="pix-texto">Digite o código do seu Gift Card Gamernac para pagar o pedido.</p>
					<label class="campo-linha">Código do Gift Card
						<input type="text" id="giftcard-codigo" placeholder="GMR-XXXX-XXXX-XXXX" maxlength="19" required>
					</label>
					<button type="button" id="giftcard-validar" class="hero-btn2">Validar código</button>
					<p id="giftcard-status" class="giftcard-status"></p>
				</div>
			</div>

		</div>

		<aside class="checkout-resumo">
			<h2>Resumo do pedido</h2>
			<div id="checkout-itens" class="checkout-itens"></div>
			<div class="checkout-total-linha">
				<span>Subtotal</span>
				<strong id="checkout-subtotal">R$ 0,00</strong>
			</div>
			<div class="checkout-total-linha total">
				<span>Total</span>
				<strong id="checkout-total">R$ 0,00</strong>
			</div>
			<button type="button" id="checkout-confirmar" class="hero-btn checkout-confirmar-btn">Confirmar pagamento</button>
			<a href="carrinho.php" class="checkout-voltar">← Voltar ao carrinho</a>
		</aside>

	</div>

	<div id="checkout-sucesso" class="checkout-sucesso" hidden>
		<span class="checkout-sucesso-icone">✔</span>
		<h2>Pagamento confirmado!</h2>
		<p>Seu pedido <strong id="checkout-numero-pedido"></strong> foi processado com sucesso.</p>
		<p class="checkout-sucesso-metodo" id="checkout-sucesso-metodo"></p>
		<a href="index.php" class="hero-btn">Voltar à loja</a>
	</div>

</section>

<?php include 'rodape.php'; ?>

<script>
(function () {
	var metodos = document.querySelectorAll('.metodo-card');
	var formularios = document.querySelectorAll('.checkout-formulario');
	var metodoAtual = 'pix';

	function selecionarMetodo(metodo) {
		metodoAtual = metodo;
		metodos.forEach(function (m) {
			m.classList.toggle('ativo', m.dataset.metodo === metodo);
		});
		formularios.forEach(function (f) {
			f.hidden = f.dataset.form !== metodo;
		});
	}

	metodos.forEach(function (m) {
		m.addEventListener('click', function () {
			selecionarMetodo(m.dataset.metodo);
		});
	});

	function obterCarrinho() {
		return JSON.parse(localStorage.getItem('carrinho') || '[]');
	}

	function formatarPreco(valor) {
		return 'R$ ' + valor.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
	}

	var carrinho = obterCarrinho();
	var total = 0;

	if (carrinho.length === 0) {
		document.getElementById('checkout-vazio').style.display = 'block';
		document.getElementById('checkout-conteudo').style.display = 'none';
	} else {
		var listaEl = document.getElementById('checkout-itens');
		carrinho.forEach(function (item, indice) {
			total += Number(item.preco);
			var linha = document.createElement('div');
			linha.className = 'checkout-item';
			var fotoHtml = item.imagem
				? '<img src="' + item.imagem + '" alt="' + item.nome + '">'
				: '<span class="checkout-item-sem-foto">🎮</span>';
			linha.innerHTML =
				'<span class="checkout-item-foto">' + fotoHtml + '</span>' +
				'<span class="checkout-item-nome">' + item.nome + '</span>' +
				'<span class="checkout-item-preco">' + formatarPreco(Number(item.preco)) + '</span>' +
				'<button type="button" class="checkout-item-remover" title="Remover">✕</button>';
			linha.querySelector('.checkout-item-remover').addEventListener('click', function () {
				var carrinhoAtual = obterCarrinho();
				carrinhoAtual.splice(indice, 1);
				localStorage.setItem('carrinho', JSON.stringify(carrinhoAtual));
				window.location.reload();
			});
			listaEl.appendChild(linha);
		});
		document.getElementById('checkout-subtotal').textContent = formatarPreco(total);
		document.getElementById('checkout-total').textContent = formatarPreco(total);
	}

	// Parcelas do crédito (até 12x, sem juros para exemplo)
	var selectParcelas = document.getElementById('credito-parcelas');
	if (selectParcelas) {
		for (var i = 1; i <= 12; i++) {
			var opcao = document.createElement('option');
			var valorParcela = total / i;
			opcao.value = i;
			opcao.textContent = i + 'x de ' + formatarPreco(valorParcela) + (i === 1 ? ' à vista' : ' sem juros');
			selectParcelas.appendChild(opcao);
		}
	}

	// Gera código Pix fake
	function gerarCodigoPix() {
		var caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		var codigo = '00020126360014BR.GOV.BCB.PIX';
		for (var i = 0; i < 40; i++) {
			codigo += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
		}
		codigo += '5204000053039865406' + total.toFixed(2).replace('.', '') + '5802BR5913GAMERNAC LTDA6009SAOPAULO';
		return codigo;
	}
	var pixInput = document.getElementById('pix-codigo-input');
	if (pixInput) pixInput.value = gerarCodigoPix();

	var botaoCopiar = document.getElementById('pix-copiar');
	if (botaoCopiar) {
		botaoCopiar.addEventListener('click', function () {
			pixInput.select();
			pixInput.setSelectionRange(0, 99999);
			navigator.clipboard && navigator.clipboard.writeText(pixInput.value).catch(function () {});
			var textoOriginal = botaoCopiar.textContent;
			botaoCopiar.textContent = 'Copiado!';
			setTimeout(function () { botaoCopiar.textContent = textoOriginal; }, 1500);
		});
	}

	// Máscaras e preview dos cartões
	document.querySelectorAll('.cartao-numero-input').forEach(function (input) {
		input.addEventListener('input', function () {
			var digitos = input.value.replace(/\D/g, '').slice(0, 16);
			var partes = digitos.match(/.{1,4}/g) || [];
			input.value = partes.join(' ');
			var preview = document.getElementById(input.dataset.preview);
			var exibicao = partes.slice();
			while (exibicao.length < 4) exibicao.push('••••');
			preview.textContent = exibicao.join(' ');
		});
	});

	document.querySelectorAll('.cartao-nome-input').forEach(function (input) {
		input.addEventListener('input', function () {
			var preview = document.getElementById(input.dataset.preview);
			preview.textContent = input.value.trim() !== '' ? input.value.toUpperCase() : 'NOME NO CARTÃO';
		});
	});

	document.querySelectorAll('.cartao-validade-input').forEach(function (input) {
		input.addEventListener('input', function () {
			var digitos = input.value.replace(/\D/g, '').slice(0, 4);
			if (digitos.length >= 3) {
				input.value = digitos.slice(0, 2) + '/' + digitos.slice(2);
			} else {
				input.value = digitos;
			}
			var preview = document.getElementById(input.dataset.preview);
			preview.textContent = input.value !== '' ? input.value.padEnd(5, '•') : '••/••';
		});
	});

	document.querySelectorAll('.cartao-cvv-input').forEach(function (input) {
		input.addEventListener('input', function () {
			input.value = input.value.replace(/\D/g, '').slice(0, 4);
		});
	});

	// Gift card
	var giftcardValidado = false;
	var botaoGiftcard = document.getElementById('giftcard-validar');
	if (botaoGiftcard) {
		botaoGiftcard.addEventListener('click', function () {
			var codigo = document.getElementById('giftcard-codigo').value.trim();
			var status = document.getElementById('giftcard-status');
			var padrao = /^[A-Za-z0-9]{4,6}-?[A-Za-z0-9]{4}-?[A-Za-z0-9]{4}(-?[A-Za-z0-9]{4})?$/;
			if (padrao.test(codigo)) {
				giftcardValidado = true;
				status.textContent = '✔ Gift Card válido! Saldo suficiente para cobrir o pedido.';
				status.classList.add('ok');
				status.classList.remove('erro');
			} else {
				giftcardValidado = false;
				status.textContent = '✕ Código inválido. Verifique e tente novamente.';
				status.classList.add('erro');
				status.classList.remove('ok');
			}
		});
	}

	function validarFormulario() {
		if (carrinho.length === 0) return false;

		if (metodoAtual === 'pix') {
			return true;
		}

		if (metodoAtual === 'credito' || metodoAtual === 'debito') {
			var form = document.getElementById('form-' + metodoAtual);
			var numero = form.querySelector('.cartao-numero-input').value.replace(/\D/g, '');
			var nome = form.querySelector('.cartao-nome-input').value.trim();
			var validade = form.querySelector('.cartao-validade-input').value;
			var cvv = form.querySelector('.cartao-cvv-input').value;
			if (numero.length < 13 || numero.length > 16) {
				alert('Número do cartão inválido.');
				return false;
			}
			if (nome === '') {
				alert('Informe o nome impresso no cartão.');
				return false;
			}
			if (!/^\d{2}\/\d{2}$/.test(validade)) {
				alert('Validade inválida. Use o formato MM/AA.');
				return false;
			}
			if (cvv.length < 3) {
				alert('CVV inválido.');
				return false;
			}
			return true;
		}

		if (metodoAtual === 'paypal') {
			var email = document.getElementById('paypal-email').value.trim();
			if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
				alert('Informe um e-mail válido do PayPal.');
				return false;
			}
			return true;
		}

		if (metodoAtual === 'giftcard') {
			if (!giftcardValidado) {
				alert('Valide o código do Gift Card antes de continuar.');
				return false;
			}
			return true;
		}

		return false;
	}

	var nomesMetodos = {
		pix: 'Pago via Pix',
		credito: 'Pago no Cartão de Crédito',
		debito: 'Pago no Cartão de Débito',
		paypal: 'Pago via PayPal',
		giftcard: 'Pago com Gift Card'
	};

	document.getElementById('checkout-confirmar').addEventListener('click', function () {
		if (!validarFormulario()) return;

		var botao = this;
		var textoOriginal = botao.textContent;
		botao.textContent = 'Processando...';
		botao.disabled = true;

		setTimeout(function () {
			localStorage.setItem('carrinho', '[]');
			var contador = document.getElementById('carrinho-contador');
			if (contador) contador.style.display = 'none';

			var numeroPedido = '#GN' + Date.now().toString().slice(-8);
			document.getElementById('checkout-numero-pedido').textContent = numeroPedido;
			document.getElementById('checkout-sucesso-metodo').textContent = nomesMetodos[metodoAtual];

			document.getElementById('checkout-conteudo').style.display = 'none';
			document.getElementById('checkout-sucesso').hidden = false;

			botao.textContent = textoOriginal;
			botao.disabled = false;
		}, 1400);
	});
})();
</script>
</body>
</html>
