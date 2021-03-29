
<h3 align="center">
  :whale2: Projeto para estudo do symfony
</h3>

## O que é nessesario para rodar a aplicação ?

para rodar o projeto você precisará do [docker](https://www.docker.com) e [docker-compose](https://docs.docker.com/compose/) instalados no seu computador, e tambem é preciso estar tem um sistema que tenha suporte a <strong>Makefile</strong> e a scripts de <strong>bash</strong>.

- url base da api = [localhost](http://localhost:8000/);
- url da documentação do swagger = [swagger](http://localhost:8000/swagger/);

---
<h5 align="center">
  Usuarios já cadastrados no sistema
</h5>

Para transferir o dinheiro mande o cpf de quem vai transferir e o de quem vai receber e o valor a ser transferido.

Por exemplo: será mandado 2 reais do carlos para o marcos.
url do endpoint para fazer as transferencias: http://localhost:8000/api/transfer/

```
 {
    "userSendingMoney": "37584366058",
    "money": 2,
    "userReceivingMoney": "02305232924"
}
```

 - carlos
    - cpf: 02305232924
    - tipo: lojista
    - valor na carteira digital: 54.22

 - carlos
    - cpf: 37584366058
    - tipo: usuario
    - valor na carteira digital: 35.02

 - carla
    - cpf: 71507711069
    - tipo: usuario
    - valor na carteira digital: 22.22

 - marcos
    - cpf: 83605495087
    - tipo: lojista
    - valor na carteira digital: 22.22

---

## Como usar ?

- Fazer o setup do projeto
```
 make setup
```

- Depois rodar as migrations
```
 make migrate
```

- Para rodar os testes
```
 make run-all-tests
```
