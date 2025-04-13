# 💇‍♀️ Cabeleleila Leila - Sistema de Gerenciamento de Salão

Sistema web desenvolvido para gerenciar agendamentos, usuários e permissões no salão **Cabeleleila Leila**.

---

## 🚀 Tecnologias Utilizadas

- **PHP 8.x**
- **Laravel 10**
- **MySQL** – Banco de dados relacional
- **HTML5 & CSS3**
- **Bootstrap 5**
- **jQuery**
- **JavaScript (modular ES6)**

---

## ⚙️ Funcionalidades

- ✅ Cadastro e login de usuários com autenticação segura (`Hash::make`)
- ✅ Sistema de permissões com usuários do tipo `master`
- ✅ CRUD de usuários
- ✅ Agendamento de serviços
- ✅ Validações dinâmicas com retorno via Ajax
- ✅ Interface responsiva com Bootstrap

---

## 🛠️ Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/cabeleleila-leila.git
   ```

2. Instale as dependências PHP:
   ```bash
   composer install
   ```

3. Crie o arquivo `.env` com base no `.env.example` e configure o banco de dados:
   ```bash
   cp .env.example .env
   ```
   Exemplo:
   ```bash
   APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:9o+49+2yBWyX6VgbVT7l8tQW7v3HqKm/YjSPloKDx14=
    APP_DEBUG=true
    APP_URL=http://localhost
    
    APP_LOCALE=en
    APP_FALLBACK_LOCALE=en
    APP_FAKER_LOCALE=en_US
    
    APP_MAINTENANCE_DRIVER=file
    # APP_MAINTENANCE_STORE=database
    
    PHP_CLI_SERVER_WORKERS=4
    
    BCRYPT_ROUNDS=12
    
    LOG_CHANNEL=stack
    LOG_STACK=single
    LOG_DEPRECATIONS_CHANNEL=null
    LOG_LEVEL=debug
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=cabeleleila_leila
    DB_USERNAME=root
    DB_PASSWORD=root
    
    SESSION_LIFETIME=120
    SESSION_ENCRYPT=false
    SESSION_PATH=/
    SESSION_DOMAIN=null
    
    BROADCAST_CONNECTION=log
    FILESYSTEM_DISK=local
    QUEUE_CONNECTION=database
    
    CACHE_STORE=database
    # CACHE_PREFIX=
    
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
    
    SESSION_DRIVER=file
   ```

4. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
   ```

7. Inicie o servidor local:
   ```bash
   php artisan serve
   ```

Acesse o sistema em: [http://localhost:8000](http://localhost:8000)

---

## 👤 Acesso Master

Para acessar com permissões administrativas (`master`), crie um usuário e ative a flag `master` via banco ou painel (se estiver logado como admin).

---

## 📂 Estrutura Principal

- `app/Models` – Models do sistema
- `app/Http/Controllers` – Lógica das rotas
- `resources/views` – Layouts Blade
- `public/assets` – Scripts, estilos e imagens

---

## 🧪 Em desenvolvimento

- 🔄 Upload de imagens de perfil
- 📅 Calendário dinâmico de agendamentos
- 📊 Dashboard com gráficos em tempo real

---
