# pk-chemistry

**Alguns procedimentos da química**
*Neste projeto, objetivo reunir alguns procedimentos recorrentes na química, desde a montagem de moléculas até cálculos mais complexos. O WebService está com deploy automático no Heroku, com uma interface de entrada para maiores detalhes, neste [link](https://pkchemistry.herokuapp.com).*


## Funcionalidade: Análise de fórmula química e cálculo da massa molar
Consumo via WebService: https://pkchemistry.herokuapp.com/ch/comando.php?acao=mm&formula={formula}
*Substituir {formula} pela fórmula molecular desejada, por exemplo, H2SO4.*
Resposta:
```
{
  "sucesso": true,
  "formulaQuimica": "H2SO4",
  "massaMolar": 98.072
}
```


## Funcionalidade: Informações de elementos químicos
Consumo via WebService: https://pkchemistry.herokuapp.com/ch/comando.php?acao=elementos&query={query}
*Substituir {query} pelo tipo de busca, que pode ser:*
- all: Recupera todos os elementos cadastrados na tabela de resposta
- Na, K, etc: Recupera as informações específicas de um elemento, a partir do símbolo dele
- Sódio, Potássio, etc: Recupera as informações específicas de um elemento, a partir do nome dele (em português), não diferencia maiúsculas de minúsculas.
Resposta:
```
{
  "sucesso": true,
  "buscador": "Na",
  "resultado": {
    "simbolo": "Na",
    "nome": "Sódio",
    "mm": 22.99
  }
}
```
