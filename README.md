# 📚 Biblioteca Laravel

Sistema de gerenciamento de biblioteca desenvolvido como prática da disciplina de **Desenvolvimento para Web II**.

O projeto evoluiu ao longo da disciplina, passando por migrations, Eloquent, autenticação, CRUDs, sistema de empréstimos, API REST e autorização com papéis de usuário.

---

## 🚀 Funcionalidades

- **Autenticação** com papéis de usuário:
  - `admin` — pode tudo, inclusive editar papéis de outros usuários
  - `bibliotecario` — gerencia livros, autores, editoras e categorias
  - `cliente` — apenas visualiza informações
- **CRUD completo** de:
  - Livros (com upload de capa)
  - Autores
  - Editoras
  - Categorias
- **Sistema de empréstimos** com regras de negócio:
  - Limite de 5 livros emprestados simultaneamente por usuário
  - Multa de R$ 0,50 por dia de atraso (após 15 dias)
  - Usuários com débito pendente não podem realizar novos empréstimos
  - Interface para o bibliotecário gerenciar débitos
- **API REST** para o recurso `Book` (GET, POST, PUT, DELETE)
- **Autorização com Policies** para controle de permissões

---

## 🛠️ Tecnologias

- [Laravel 13](https://laravel.com)
- PHP 8.3+
- MySQL
- Bootstrap 5
- Vite
- Laravel UI (autenticação)
- Laravel Sanctum (API)

---

## 📦 Como rodar o projeto

### Pré-requisitos

- PHP 8.3 ou superior
- Composer
- Node.js e npm
- MySQL

### Passo a passo

1. **Clone o repositório:**
   git clone https://github.com/luhanfelipe/WEB-II_Biblioteca_Laravel.git
   cd WEB-II_Biblioteca_Laravel

2. **Instale as dependências PHP:**
   composer install

3. **Instale as dependências do frontend:**
   npm install

4. **Configure o arquivo .env:**
   cp .env.example .env

- Edite o .env com as credenciais do seu banco de dados:

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=biblioteca_laravel
   DB_USERNAME=root
   DB_PASSWORD=

5. **Gere a chave da aplicação**
   php artisan key:generate

6. **Crie o banco de dados no MySQL:**
   CREATE DATABASE biblioteca_laravel;

7. **Rode as migrations e popule o banco:**
   php artisan migrate --seed

8. **Crie o link simbólico para o storage (upload de imagens):**
   php artisan storage:link

9. **Rode o projeto (dois terminais):**

- Terminal 1 — Frontend:
   npm run dev

- Terminal 2 — Backend:
   composer run dev

10. **Acesse no navegador:**
   http://localhost:8000

---

## 🔑 Usuário admin padrão (criado pelo seeder)

- E-mail: admin@biblioteca.com
- Senha: 12345678

---

## 🌐 Endpoints da API

A API segue o padrão REST e retorna os dados em formato JSON.

| Método | Rota | Descrição |
|--------|------|-----------|
| `GET` | `/api/books` | Lista todos os livros cadastrados |
| `GET` | `/api/books/{id}` | Exibe os dados de um livro específico |
| `POST` | `/api/books` | Cria um novo livro |
| `PUT` | `/api/books/{id}` | Atualiza um livro existente |
| `DELETE` | `/api/books/{id}` | Remove um livro |

### 📥 Exemplo de requisição (POST)

curl -X POST http://localhost:8000/api/books \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "title=O Mágico de Oz" \
  -d "pages=218" \
  -d "author_id=1" \
  -d "category_id=2" \
  -d "publisher_id=1"

---

## 📄 Licença

Este projeto utiliza o framework Laravel, que é um software open-source licenciado sob a MIT license.

---

## 🙏 Créditos

Este projeto foi construído com o apoio das seguintes ferramentas e bibliotecas:

| Ferramenta | Descrição |
|------------|-----------|
| [Laravel](https://laravel.com) | Framework PHP utilizado em toda a aplicação |
| [Laravel UI](https://github.com/laravel/ui) | Scaffolding de autenticação (login, registro, etc.) |
| [Laravel Sanctum](https://github.com/laravel/sanctum) | Autenticação de API com tokens |
| [Bootstrap](https://getbootstrap.com) | Framework CSS para estilização da interface |
| [Bootstrap Icons](https://icons.getbootstrap.com) | Ícones utilizados nos botões e menus |
