## Requisitos do Sistema

#### [MySQL][1].

#### PHP versão 7.1.3 (ou posterior).

#### Caso tenha dificuldade em montar o ambiente para o LARAVEL use o XAMMP versão 3.2.4 (OPCIONAL)

#### [Composer][2].

#### [Insomnia][3] instalado para testes (OPCIONAL).

#### IDE VSCODE (OPCIONAL).

---

# A solução

#### A solução foi desenvolvida no framework LARAVEL[6] para atender as premissa de escalabilidade e favorecer a Stack do PHP.

---

# Instalação

## Passos para instalação

### Instalação do repositório.

#### 1. Após a instalação dos requisitos e inicialização do Apache, faça o clone do projeto.

    cd <diretório base do repositório>
    git clone https://github.com/thiagohome2/desafio-backend.git

#### 2. Duplique o arquivo .env.exemple e renomeie para .env.

### Istalação do banco de dados

#### 1. Crie um novo banco no MySql com o nome que preferir

#### 2. Configure o arquivo .env

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=<nome do banco>
    DB_USERNAME=<seu usuario>
    DB_PASSWORD=<sua senha>

### Execute o seguinte comando no Prompt de Comando para acessar a pasta do repositório.

    cd <diretório base do repositório>\desafio-backend\store

#### 1. Uma vez que esteja na pasta \store, execute o comando para instalação do Composer no diretório.

    composer install

#### 2. Execute o comando para gerar a APP_KEY, (Será inserida automaticamente no arquivo .env)

    php artisan key:generate

#### 3. Execute o comando para criar as tabelas do banco de dados.

    php artisan migrate

#### 4. Execute o comando para inicialização do ambiente.

    php artisan serve

### Teste da Aplicação

#### 1. Execute o teste automatizado da aplicação com o comando:

    ./vendor/bin/phpunit

#### 2. Na aplicação existe um arquivo para importação no insominia com as rotas configuradas para teste manual:

    /store/Insomnia_2019-11-21.json".

##### 2.1 Importe eo arquivo acima no Insomnia
