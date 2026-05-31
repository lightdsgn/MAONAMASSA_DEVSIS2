Esse fluxo ficou mais claro porque reflete o que o sistema realmente faz. Eu só organizaria um pouco para eliminar repetições:

# Fluxo Prestador → Cliente

Este documento descreve o fluxo principal da plataforma, onde o prestador disponibiliza serviços e o cliente os contrata por meio da criação de agendamentos.

## 1. Cadastro do Serviço

* O prestador autenticado cadastra um serviço na plataforma.
* O serviço registra informações como título, descrição, categoria, preço e disponibilidade.
* Após o cadastro, o serviço fica disponível para visualização pelos clientes.

⬇️

## 2. Escolha do Serviço

* O cliente autenticado navega pelos serviços disponíveis.
* O cliente seleciona o serviço que deseja contratar.

⬇️

## 3. Criação do Agendamento

* O cliente cria um agendamento para o serviço selecionado.
* Durante esse processo, informa:

  * data;
  * horário;
  * observações adicionais.

⬇️

## 4. Geração Automática da Solicitação e do Orçamento

Ao criar o agendamento, o sistema gera automaticamente:

### Solicitação

* Vinculada ao cliente e ao serviço escolhido.
* Registrada com status **Em Andamento**.

### Orçamento

* Vinculado à solicitação criada.
* Utiliza o valor do campo **preço estimado** do serviço.
* É registrado automaticamente com status **Aceito**.

⬇️

## 5. Análise do Agendamento pelo Prestador

O prestador recebe a solicitação de agendamento e pode:

### ❌ Recusar

* O processo é encerrado.
* O serviço não será executado.

### ✅ Aceitar

* O agendamento é confirmado.
* O fluxo segue para execução do serviço.

⬇️

## 6. Execução do Serviço

* O prestador realiza o serviço na data e horário definidos.
* A conclusão da atividade confirma a entrega do trabalho contratado.

⬇️

## 7. Avaliação do Serviço

* Após a conclusão, o cliente pode registrar uma avaliação.
* A avaliação contém:

  * nota;
  * comentário;
  * vínculo com o serviço executado.

---

## Resumo do Fluxo

1. Prestador cadastra um serviço.
2. Cliente seleciona o serviço.
3. Cliente cria um agendamento.
4. Sistema gera automaticamente uma solicitação e um orçamento.
5. Prestador aceita ou recusa o agendamento.
6. Prestador executa o serviço.
7. Cliente avalia o serviço.

> Fluxo Prestador → Cliente: o prestador disponibiliza seus serviços na plataforma e o cliente realiza a contratação, acompanhamento e avaliação do serviço prestado.
