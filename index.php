<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEP SENAI</title>

    <!-- Fontes do Google: Sora (títulos), IBM Plex Sans (texto) e IBM Plex Mono (números do CEP) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;600&family=IBM+Plex+Sans:wght@400;500;600&family=Sora:wght@600;700&display=swap">

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- ===== Cabeçalho fixo com a marca e o menu ===== -->
    <header class="topo">
        <div class="topo__conteudo">
            <a href="#sobre" class="marca">
                <!-- "Selo" que imita a etiqueta de CEP de uma carta -->
                <span class="marca__selo" aria-hidden="true">CEP</span>
                <span class="marca__nome">CEP <strong>SENAI</strong></span>
            </a>

            <nav class="menu" aria-label="Navegação principal">
                <a href="#sobre">Sobre</a>
                <a href="#busca" class="menu__destaque">Buscar CEP</a>
            </nav>
        </div>
    </header>

    <main>

        <!-- ===== SEÇÃO 1: Apresentação do projeto ===== -->
        <section id="sobre" class="secao apresentacao">
            <div class="secao__conteudo apresentacao__grade">

                <div class="apresentacao__texto">
                    <p class="etiqueta">Unidade Curricular · Interação com APIs</p>

                    <h1>Encontre qualquer endereço do Brasil pelo CEP</h1>

                    <p class="apresentacao__lead">
                        O <strong>CEP SENAI</strong> é o projeto prático da UC
                        <strong>Interação com APIs</strong>. A interface já está pronta:
                        sua missão é fazer ela conversar com uma API pública de CEP e
                        mostrar o endereço na tela.
                    </p>

                    <!-- Lista do que a turma vai praticar no projeto -->
                    <ul class="aprendizados">
                        <li><strong>fetch()</strong> para fazer requisições HTTP</li>
                        <li><strong>JSON</strong> para ler a resposta da API</li>
                        <li><strong>async / await</strong> para lidar com o tempo de espera</li>
                        <li><strong>Tratamento de erros</strong> quando o CEP não existe</li>
                    </ul>

                    <a href="#busca" class="botao">Começar a busca</a>
                </div>

                <!-- Exemplo visual de uma requisição: mostra para a turma o "caminho" da API -->
                <figure class="requisicao" aria-label="Exemplo de requisição a uma API de CEP">
                    <figcaption class="requisicao__titulo">
                        <span class="requisicao__metodo">GET</span>
                        viacep.com.br/ws/<mark>01001000</mark>/json/
                    </figcaption>
                    <pre class="requisicao__codigo"><code>{
  "cep": "01001-000",
  "logradouro": "Praça da Sé",
  "bairro": "Sé",
  "localidade": "São Paulo",
  "uf": "SP",
  "ddd": "11"
}</code></pre>
                    <p class="requisicao__status">200 OK · application/json</p>
                </figure>

            </div>
        </section>

        <!-- ===== SEÇÃO 2: Busca do CEP ===== -->
        <section id="busca" class="secao busca">
            <div class="secao__conteudo">

                <header class="secao__cabecalho">
                    <p class="etiqueta">Passo a passo</p>
                    <h2>Buscar CEP</h2>
                    <p>Digite os 8 números do CEP. O traço é colocado automaticamente.</p>
                </header>

                <div class="busca__grade">

                    <!-- Formulário de busca -->
                    <form id="form-busca" class="formulario" novalidate>
                        <label for="campo-cep" class="formulario__rotulo">CEP</label>

                        <div class="formulario__linha">
                            <input type="text" id="campo-cep" name="cep" class="formulario__campo" placeholder="00000-000" inputmode="numeric" maxlength="9" autocomplete="postal-code" required>
                            <button type="submit" id="botao-buscar" class="botao">Buscar</button>
                        </div>

                        <!-- Mensagens de status (carregando, erro, aviso). aria-live avisa leitores de tela -->
                        <p id="mensagem" class="mensagem" aria-live="polite"></p>

                        <p class="formulario__dica">
                            Exemplos para testar: <button type="button" class="exemplo" data-cep="01001000">01001-000</button>
                            <button type="button" class="exemplo" data-cep="20040020">20040-020</button>
                            <button type="button" class="exemplo" data-cep="70040010">70040-010</button>
                        </p>
                    </form>

                    <!-- Card de resultado. Cada campo tem um id para o JavaScript preencher -->
                    <article id="resultado" class="card">
                        <header class="card__topo">
                            <span class="card__rotulo">CEP</span>
                            <p id="res-cep" class="card__cep">01001-000</p>
                            <span id="res-uf" class="card__uf">SP</span>
                        </header>

                        <address class="card__endereco">
                            <strong id="res-logradouro" class="card__logradouro">Praça da Sé</strong>
                            <span id="res-complemento" class="card__complemento">lado ímpar</span>
                            <span>
                                <span id="res-bairro">Sé</span> ·
                                <span id="res-localidade">São Paulo</span>
                            </span>
                        </address>

                        <!-- <dl> = lista de definição: termo (dt) + valor (dd) -->
                        <dl class="card__codigos">
                            <div class="card__item">
                                <dt>DDD</dt>
                                <dd id="res-ddd">11</dd>
                            </div>
                            <div class="card__item">
                                <dt>IBGE</dt>
                                <dd id="res-ibge">3550308</dd>
                            </div>
                        </dl>

                        <footer class="card__rodape">
                            <span id="res-aviso" class="card__selo">Exemplo</span>
                            Os dados aparecem aqui depois da busca
                        </footer>
                    </article>

                </div>
            </div>
        </section>

    </main>

    <footer class="rodape">
        <p>CEP SENAI · Projeto da UC Interação com APIs</p>
    </footer>

    <script src="script.js"></script>
</body>

</html>