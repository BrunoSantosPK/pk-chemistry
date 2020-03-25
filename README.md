# pk-chemistry
Alguns procedimentos da química (some procedures of chemistry)

Aqui, pretendo reunir alguns procedimentos recorrentes na química, desde montagem de moléculas até cálculos mais complexos.

Esse projeto está em uma pipeline de deploy automatizado, no heroku.
As funcionalidades podem ser acessadas não só pela interface, mas pelo web service.

===========================

Funcionalidade: Análise de fórmula química e cálculo da massa molar
Consumindo: https://pkchemistry.herokuapp.com/ch/comando.php?acao=mm&formula={formula}
  Substituir {formula} pela fórmula química a ser analisada, por exemplo, H2SO4
Exemplo de resposta JSON:
{
  "sucesso": true,
  "formulaQuimica": "H2SO4",
  "massaMolar": 98.072
}
  
Funcionalidade: Informações de elementos químicos
Consumindo: https://pkchemistry.herokuapp.com/ch/comando.php?acao=elementos&query={query}
  Substituir {query} pelo tipo de busca
    -> all: Recupera todos os elementos cadastrados na tabela de resposta
    -> Na, K, etc: Recupera as informações específicas de um elemento, a partir do símbolo dele
    -> Sódio, Potássio, etc: Recupera as informações específicas de um elemento, a partir do nome dele (em português), não diferencia maiúsculas de minúsculas.
Exemplo de resposta JSON:
{
  "sucesso": true,
  "buscador": "Na",
  "resultado": {
    "simbolo": "Na",
    "nome": "Sódio",
    "mm": 22.99
  }
}
