![CredPago](http://cp-arquivos-publicos.s3-website-sa-east-1.amazonaws.com/imagens/credpago.png)

# Desafio Backend

Este desafio consiste em criar uma API REST para um marketplace de DVDs que será consumido por um aplicativo mobile e uma aplicação web.
Todos os itens serão colocados em um carrinho de compras e enviados para a API realizar uma transação de comércio eletrônico.

## Instruções

Faça o **fork** deste repositório e quando concluir o desafio faça um **pull request**, sinalizando que podemos iniciar a nossa avaliação.

Escolha a tecnologia que achar melhor, contudo, deverá informar quais tecnologias foram usadas, como instalar, rodar e efetuar os acessos no arquivo para análise do desafio.

### POST `/store/api/v1/product`
Esse método deve receber um item novo e persistir no banco de dados.
```json
{
   "product_id":"d2eda25e-9757-11e9-bc42-526af7764f64",
   "title":"Ferris Bueller's Day Off",
   "year":1986,
   "director":"John Hughes",
   "price":130,
   "store":"Grande Loja de DVDs",
   "thumb":"https://m.media-amazon.com/images/I/61a0fvXyuWL._AC_UY218_.jpg",
   "date":"26/11/2018"
}
```
+ Product
  
| Campo       | Tipo    |
|-------------|---------|
| product_id  | String  |
| title       | String  |
| director    | String  |
| album       | String  |
| price       | Integer |
| store       | String  |
| thumb       | String  |
| date        | String  |

### GET `/store/api/v1/products`
Retornar uma lista de produtos no seguinte formato JSON
```json
[
  {
    "product_id":"d2eda25e-9757-11e9-bc42-526af7764f64",
    "title":"Ferris Bueller's Day Off",
    "year":1986,
    "director":"John Hughes",
    "price":130,
    "store":"Grande Loja de DVDs",
    "thumb":"https://m.media-amazon.com/images/I/61a0fvXyuWL._AC_UY218_.jpg",
    "date":"26/11/2018"
  },
  {
    "product_id":"4a149a9a-9758-11e9-bc42-526af7764f64",
    "artist":"Cobra",
    "year":1986,
    "director":"George P. Cosmatos",
    "price":100,
    "store":"Super DVD",
    "thumb":"https://images-na.ssl-images-amazon.com/images/I/714Zaw7zc3L._SX300_.jpg",
    "date":"01/02/2019"
  },
  {
    "product_id":"53f2b33a-9758-11e9-bc42-526af7764f64",
    "artist":"Commando",
    "year":1985,
    "director":"Mark L. Lester",
    "price":180,
    "store":"DVD Old School",
    "thumb":"https://images-na.ssl-images-amazon.com/images/I/91AxSyNppIL._UR150,200_FMJPG_.jpg",
    "date":"13/06/2019"
  }
]
```

+ Product
  
| Campo       | Tipo    |
|-------------|---------|
| product_id  | String  |
| title       | String  |
| year        | Integer |
| director    | String  |
| price       | Integer |
| store       | String  |
| thumb       | String  |
| date        | String  |

### POST `/store/api/v1/add_to_cart`
Adicionar item ao carrinho.
```json
{
   "cart_id":"c5b6c552-9757-11e9-bc42-526af7764f64",
   "client_id":"fac3591c-9785-11e9-bc42-526af7764f64",
   "product_id":"d2eda25e-9757-11e9-bc42-526af7764f64",
   "date":"26/11/2018"
   "time":"18:33:12"
}
```
+ Cart
  
| Campo       | Tipo    |
|-------------|---------|
| cart_id     | String  |
| client_id   | Integer |
| product_id  | String  |
| date        | String  |
| time        | String  |

Após o cliente incluir todos itens no carrinho, a compra será finalizada, invocando o método `buy` na sua API.

### POST `/store/api/v1/buy`
Finalizar a compra.
```json
{
   "client_id":"fac3591c-9785-11e9-bc42-526af7764f64",
   "cart_id":"c5b6c552-9757-11e9-bc42-526af7764f64",
   "client_name":"John Mayer",
   "value_to_pay":130,
   "credit_card":{
      "number":"1234123412341234",
      "cvv":111,
      "exp_date":"06/22",
      "card_holder_name":"John M",
   }
}
```

+ Transaction

| Campo        | Tipo       |
|--------------|------------|
| client_id    | String     |
| client_name  | String     |
| total_to_pay | Integer    |
| credit_card  | CreditCard |

+ CreditCard

| Campo            | Tipo    |
|------------------|---------|
| card_number      | String  |
| card_holder_name | String  |
| cvv              | Integer |
| exp_date         | String  |


### GET `/store/api/v1/history`
Esse método deve retornar todos as compras realizadas na API
```json
[
   {
      "client_id":"fac3591c-9785-11e9-bc42-526af7764f64",
      "order_id":"569c30dc-6bdb-407a-b18b-3794f9b206a1",
      "card_number":"**** **** **** 1234",
      "value":100,
      "date":"21/08/2018"
   },
   {
      "client_id":"fac3591c-9785-11e9-bc42-526af7764f64",
      "order_id":"569c30dc-6bdb-407a-b18b-3794f9b206a2",
      "card_number":"**** **** **** 1234",
      "value":130,
      "date":"20/02/2019"
   },
   {
      "client_id":"fac3591c-9785-11e9-bc42-526af7764f64",
      "order_id":"569c30dc-6bdb-407a-b18b-3794f9b206aa",
      "card_number":"**** **** **** 1234",
      "value":500,
      "date":"29/06/2019"
   }
]
```

+ History

| Campo            | Tipo    |
|------------------|---------|
| card_number      | String  |
| cliend_id        | String  |
| value            | Integer |
| order_id         | String  |

### GET `/store/api/v1/history/{clientId}`
Chamada da API deve retornar todos as compras realizadas por um cliente específico
```json
[
   {
      "client_id":"fac3591c-9785-11e9-bc42-526af7764f64",
      "order_id":"569c30dc-6bdb-407a-b18b-3794f9b206a1",
      "value":180,
      "date":"19/01/2019",
      "card_number":"**** **** **** 1234"
   },
   {
      "client_id":"fac3591c-9785-11e9-bc42-526af7764f64",
      "order_id":"569c30dc-6bdb-407a-b18b-3794f9b206a2",
      "value":100,
      "date":"20/06/2019",
      "card_number":"**** **** **** 1234"
   }
]
```

### Premissas
- A solução deve ser escalável, preparada para receber um grande volume de requisições;
- Os endpoints do serviço devem responder num tempo satisfatório, que não comprometa a experiência dos usuários, mesmo com um grande volume de dados;
- O desenvolvimento pode ser feito utilizando qualquer linguagem de programação e qualquer sistema de banco de dados, cabendo ao desenvolvedor escolher o que for melhor para a situação;
- Serão avaliados a arquitetura, os padrões utilizados para o desenvolvimento, documentação, arquitetura da solução e a entrega no prazo;
