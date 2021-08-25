# Api de Contracheques

Este é um exemplo básico de um aplicativo Laravel fornecendo uma API REST com objetivo de expor valores calculados para descrição da folha de pagamento de funcionarios cadastrados.

Os funcionarios precisam ser cadastrados via endpoint exposto pela api.

As formulas de calculo estão persistidas no banco de dados e são flexiveis para pronta edição. 

## Instalar dentro container e carregar dependencias

     sudo git clone https://github.com/igorcanalli/contra-cheque . && sudo composer install --optimize-autoloader

#### Renomeie o arquivo ".env.example" para ".env" e configure sua conexao com o banco de dados
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=<database_name>
    DB_USERNAME=<username_name>
    DB_PASSWORD=<password>

##### Para atualizando as configuraçoes em cache e gerando as migrações da base de dados

     sudo php artisan config:cache && sudo php artisan key:generate && sudo php artisan config:clear && sudo php artisan config:cache && sudo php artisan migrate --seed

###### Para executar os testes (dentro do container)

    sudo php artisan test --testsuite=Feature --stop-on-failure

# Pode ser que seja capaz aplicar as permissoes para seu usuario fora do container
        chown -R admin storage/ && chmod 777 -R storage/

# REST API

## listar funcionario

### Request

`GET api/funcionario/{id}/show`

    curl -i -H 'Accept: application/json' http://localhost/api/funcionario/{id}/show

#### Response

    HTTP/1.1 200 OK
    Server: nginx
    Content-Type: text/html; charset=UTF-8
    Transfer-Encoding: chunked
    Connection: keep-alive
    Cache-Control: no-cache, private
    Date: Wed, 25 Aug 2021 00:12:14 GMT
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 57
    Access-Control-Allow-Origin: *

# Criar Funcionario

## Request

`POST api/funcionario/store`

    curl -i -H 'Accept: application/json' -d 'nome=FULANO&sobrenome=CICLANO&cpf=583.230.330-05&setor=dat&salario_bruto=2500&data_admissao=2021-08-23&plano_saude=1&plano_dental=1&vale_transporte=1' http://localhost/api/funcionario/store

### Parameters

    - nome: string, maximoChar = 20,
    - sobrenome:  string, maximoChar = 20,
    - cpf: string, precisa ser um cpf valido,
    - setor: string, precisa ser a sigla de um setor cadastrado
    - salario_bruto => unsigned float,
    - data_admissao => date,
    - plano_saude => flag (0 ou 1)    
    - plano_dental => flag (0 ou 1)   
    - vale_transporte => flag (0 ou 1) 

    setores cadastrados:
        drh (Departamento de RH)
        dat (DDepartamento de atendimento)
        dle (DDepartamento de Legalização)
        dfi (DDepartamento Fiscal)
        dco (DDepartamento Contábil)

#### Response

    HTTP/1.1 200 OK
    Server: nginx
    Content-Type: application/json
    Transfer-Encoding: chunked
    Connection: keep-alive
    Cache-Control: no-cache, private
    Date: Wed, 25 Aug 2021 00:17:40 GMT
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 58
    Access-Control-Allow-Origin: *

   {"message":"Funcionario Criado com Sucesso"}

## listar Contracheque

`GET api/contra-cheque/{id_do_funcionario}/show`

    curl -i -H 'Accept: application/json' http://localhost/contra-cheque/{id_do_funcionario}/show

### Response

    HTTP/1.1 200 OK
    Server: nginx
    Content-Type: application/json
    Transfer-Encoding: chunked
    Connection: keep-alive
    Cache-Control: no-cache, private
    Date: Wed, 25 Aug 2021 00:15:11 GMT
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 59
    Access-Control-Allow-Origin: *

** EM TODAS AS REQUISIÇÕES, É NECESSARIO PASSAR O CABEÇALHO Accept=application/json**