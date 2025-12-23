
## Passo a passo para executar o projeto PokeApi

O projeto foi feito em Laravel/Blade, sendo necessário executar alguns comandos via terminal para acesso as telas:

- Primeiro passo, clone o projeto no Github:
    - No repositório do Github(https://github.com/wesleyguimaraes900/pokeapi-app-wesley), clique em "Code". Dentro dele você vai conseguir os links para clonagem.
- Após clonar o projeto no seu computador, via Terminal, acesse a pasta do projeto e no terminal, digite os seguintes comandos em sequencia:
    - Verifique se vocÊ possui o Laravel instalado na máquina, digite "laravel --version". Deve retornar algo como "Laravel Installer 5.23.2".
    - Se não tiver o Laravel instalado, faça essas seguintes ações e depois clone o projeto no Github. Execute esses comandos: "composer global require laravel/installer", e depois "laravel new pokeapi-app-wesley".
- Após Laravel instalado e o projeto clonado, execute o próximo comando para instalar todas as dependências:
    - npm install
    - npm run build


## Banco de dados

- Antes rodar o projeto executo o seguinte comnando para rodar as Migrations e criar as tabelas:
    - php artisan migrate
- Rode o projeto com o seguinte comando:
    - php artisan serve
- Após rodar o projeto você conseguirá acessar as telas através do link que aparece logo embaixo. Algo semelhante a isso "http://127.0.0.1:8000".
- De inicio você verá uma tela com a logo "Pokemón", e no canto superior direito o botão "Log in", clique nele e você verá a tela para logar no sistema.
- Para possuir usuário para logar, volte para o terminal e execute o seguinte comando para rodar o Seeder:
    - php artisan db:seed --class=UsersTableSeeder
- Após rodar o comando Seeder será gerado esse usuário e senha:
    - Usuário: admin@pokemon.com
    - Senha: rootA123456


## Acessando o sistema

- Volte a para a tela de Login e log com o usuário criado.
- Você verá uma listagem de Pokemons, listagem essa feita somente com o retorno da api. A paginação e limite de exibição em tela também foi feita consumindo a api.
- Com o filtro é possivel buscar 1 pokemon por vez através do Nome do Pokemon.
- Na listagem você encontra as opções de "Detalhes" e "Importar":
    - Clicando em "Detalhes" é exibido uma tela com alguns detalhes do Pokemon.
    - Clicando em "Importar" é possivel importar os dados do Pokemon para o banco de dado interno.
- Na listagem existe o campo "status", onde é indicado se aquele Pokemon ja foi Importado ou não para o banco interno. 
    - Caso tente importar um pokemon que já esta no banco interno, é retornado uma mensagem dizendo que a importação ja foi feita, impedindo duplicação.


## Exemplo .env:
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:+rP+pPYKIu9YeMPUYCAPdwdrWhg2u7bD12A9582kNU0=
APP_DEBUG=true
APP_URL=http://localhost:8000

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pokeapi_app_wesley
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"

