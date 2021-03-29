
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

 - carlos
    - cpf: 02305232924

 - carlos
    - cpf: 37584366058

 - carla
    - cpf: 71507711069

 - marcos
    - cpf: 83605495087

---

## Como usar ?

- Fazer o setup do projeto
```
 make setup
```

- Buildar os containers
```
 make build
```

- Iniciar os containers
```
 make start
```

- Derrubar os containers
```
 make down
```

- Rodar as migrations
```
 make migrate
```
