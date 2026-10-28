/* =========================================================
   CEP SENAI · script.js
   Aqui fica só a parte VISUAL: máscara do campo, validação
   e funções que mudam a tela. A chamada à API fica para a
   função buscarCep(), lá embaixo.
   ========================================================= */

// ===== Pegando os elementos da página =====
const formulario = document.querySelector("#form-busca");
const campoCep = document.querySelector("#campo-cep");
const botaoBuscar = document.querySelector("#botao-buscar");
const mensagem = document.querySelector("#mensagem");
const cardResultado = document.querySelector("#resultado");

// ===== Máscara: deixa só números e coloca o traço (00000-000) =====
campoCep.addEventListener("input", () => {
  const numeros = campoCep.value.replace(/\D/g, "").slice(0, 8); // remove tudo que não é dígito

  campoCep.value = numeros.length > 5
    ? numeros.slice(0, 5) + "-" + numeros.slice(5)
    : numeros;

  campoCep.classList.remove("invalido");
});

// ===== Botões de exemplo: preenchem o campo e enviam o formulário =====
document.querySelectorAll(".exemplo").forEach((botao) => {
  botao.addEventListener("click", () => {
    campoCep.value = botao.dataset.cep;
    campoCep.dispatchEvent(new Event("input")); // aplica a máscara
    formulario.requestSubmit();
  });
});

// ===== Envio do formulário =====
formulario.addEventListener("submit", (evento) => {
  evento.preventDefault(); // impede a página de recarregar

  const cep = campoCep.value.replace(/\D/g, ""); // só os 8 números

  if (cep.length !== 8) {
    campoCep.classList.add("invalido");
    mostrarMensagem("Digite um CEP com 8 números.", "erro");
    campoCep.focus();
    return;
  }

  buscarCep(cep);
});

// =========================================================
// Funções que mudam a tela (use dentro da sua buscarCep)
// =========================================================

// Mostra um texto abaixo do campo. tipo: "carregando", "erro", "sucesso" ou "aviso"
function mostrarMensagem(texto, tipo) {
  mensagem.textContent = texto;
  mensagem.className = "mensagem mensagem--" + tipo;
}

// Liga ou desliga o estado de "buscando..."
function mostrarCarregando(ativo) {
  botaoBuscar.disabled = ativo;
  cardResultado.classList.toggle("carregando", ativo);

  if (ativo) {
    mostrarMensagem("Buscando endereço...", "carregando");
  }
}

// Preenche o card. Os nomes seguem as chaves do JSON da ViaCEP
function mostrarResultado(dados) {
  document.querySelector("#res-cep").textContent = dados.cep;
  document.querySelector("#res-uf").textContent = dados.uf;
  document.querySelector("#res-logradouro").textContent = dados.logradouro || "Logradouro não informado";
  document.querySelector("#res-complemento").textContent = dados.complemento || "";
  document.querySelector("#res-bairro").textContent = dados.bairro || "—";
  document.querySelector("#res-localidade").textContent = dados.localidade;
  document.querySelector("#res-ddd").textContent = dados.ddd || "—";
  document.querySelector("#res-ibge").textContent = dados.ibge || "—";

  // Troca o selo "Exemplo" por "Resultado"
  document.querySelector("#res-aviso").textContent = "Resultado";

  mostrarMensagem("Endereço encontrado!", "sucesso");
}

// =========================================================
// ⚠️ PARTE DA API: implemente aqui
// =========================================================
function buscarCep(cep) {
  // TODO: fazer a requisição para a API usando o cep (8 números)
  // e depois chamar mostrarResultado(dados) ou mostrarMensagem("...", "erro").

  // Por enquanto, só simula a espera para dar para ver o visual:
  mostrarCarregando(true);

  setTimeout(() => {
    mostrarCarregando(false);
    mostrarMensagem("Interface pronta! Falta conectar a API na função buscarCep().", "aviso");
  }, 900);
}
