# README — Grimório RPG

## Sobre o projeto

Grimório RPG é um sistema web inspirado nas fichas de Dungeons & Dragons 5ª edição, desenvolvido com Laravel e Tailwind CSS. O objetivo do projeto é permitir que jogadores criem, gerenciem e visualizem fichas completas de personagens de RPG de mesa através de uma interface moderna, temática e interativa.

O sistema foi construído com foco em:

* Experiência visual imersiva;
* Organização modular;
* Facilidade de expansão futura;
* Automação de cálculos de RPG;
* Gerenciamento completo de personagens.

---

# Funcionalidades atuais

## Sistema de autenticação

* Cadastro de usuários;
* Login e logout;
* Recuperação de senha;
* Proteção de rotas com autenticação;
* Cada usuário acessa apenas seus próprios personagens.

---

## Fichas de personagens

### Cadastro de personagens

O sistema permite criar personagens contendo:

* Nome;
* Raça;
* Classe;
* Nível;
* Antecedente;
* Tendência;
* Nome do jogador;
* Experiência;
* História do personagem.

---

## Atributos

Os personagens possuem os 6 atributos clássicos de D&D:

* Força;
* Destreza;
* Constituição;
* Inteligência;
* Sabedoria;
* Carisma.

O sistema calcula automaticamente:

* Modificadores de atributos;
* Bônus de proficiência;
* Perícias;
* Testes de resistência;
* Sabedoria passiva;
* Iniciativa;
* Deslocamento.

---

## Vida do personagem

O sistema possui:

* Pontos de vida máximos;
* Pontos de vida atuais;
* Barra visual de vida;
* Botão para sofrer dano;
* Botão para recuperar vida.

---

## Inventário / Equipamentos

Cada personagem possui um inventário próprio.

O sistema permite:

* Adicionar itens;
* Editar itens;
* Excluir itens;
* Organizar equipamentos.

A tela foi planejada visualmente para parecer uma mochila medieval.

---

## Arsenal

Sistema de gerenciamento de armas.

Cada arma pode possuir:

* Nome;
* Tipo de dano;
* Dado de dano;
* Alcance;
* Proficiência;
* Bônus de ataque.

O sistema futuramente permitirá:

* Ataques automáticos;
* Rolagens automáticas;
* Integração com atributos.

---

## Grimório

Sistema de gerenciamento de magias.

Cada magia pode possuir:

* Nome;
* Nível da magia;
* Alcance;
* Duração;
* Tipo;
* Descrição.

Planejado para funcionar visualmente como um livro mágico.

---

## Habilidades e características

CRUD completo para:

* Habilidades;
* Características.

O usuário pode:

* Criar;
* Editar;
* Excluir;
* Organizar registros.

---

## Idiomas e proficiências

Sistema independente para:

* Idiomas;
* Proficiências adicionais.

---

## Aparência do personagem

Sistema para armazenar:

* Altura;
* Peso;
* Cor dos olhos;
* Cabelo;
* Pele;
* Descrição física.

---

## Sistema de moedas

Controle de:

* PC (Peças de cobre);
* PP (Peças de prata);
* PE (Peças de estanho);
* PO (Peças de ouro);
* PL (Peças de platina).

As moedas são atualizadas automaticamente diretamente na ficha.

---

## Interface temática

A interface utiliza:

* Estilo de pergaminho;
* Tons medievais;
* Estética inspirada em RPG de mesa;
* Botões temáticos;
* Layout inspirado em fichas de D&D.

---

# Tecnologias utilizadas

## Backend

* PHP 8.3
* Laravel 13

## Frontend

* Blade
* Tailwind CSS
* Vite
* JavaScript

## Banco de dados

* MySQL

## Ferramentas auxiliares

* Composer
* Artisan
* npm
* Node.js
* Git
* GitHub

---

# Estrutura do projeto

## Controllers

Responsáveis pelas regras do sistema.

Exemplo:

```text
app/Http/Controllers
```

---

## Models

Representam as tabelas do banco.

Exemplo:

```text
app/Models
```

---

## Views

Arquivos Blade responsáveis pelas telas.

Exemplo:

```text
resources/views
```

---

## Rotas

Definem os endereços do sistema.

Arquivo:

```text
routes/web.php
```

---

## Migrations

Responsáveis pela estrutura do banco de dados.

Exemplo:

```text
database/migrations
```

---

# Instalação do projeto

## Clonar repositório

```bash
git clone URL_DO_REPOSITORIO
```

---

## Entrar na pasta

```bash
cd grimorio-rpg
```

---

## Instalar dependências PHP

```bash
composer install
```

---

## Instalar dependências frontend

```bash
npm install
```

---

## Configurar arquivo .env

Copiar:

```text
.env.example
```

para:

```text
.env
```

---

## Gerar chave do Laravel

```bash
php artisan key:generate
```

---

## Executar migrations

```bash
php artisan migrate
```

---

## Criar link do storage

```bash
php artisan storage:link
```

---

## Rodar servidor backend

```bash
php artisan serve
```

---

## Rodar frontend

```bash
npm run dev
```

---

# Melhorias futuras

* Rolagem automática de dados;
* Sistema de combate;
* Exportação de ficha em PDF;
* Upload de imagem do personagem;
* Sistema de campanha;
* Compartilhamento de personagens;
* Inventário avançado;
* Sistema de condições e efeitos.

---

# Autor

Projeto desenvolvido por Pedro Lucas.

---

# GUIA TÉCNICO DO PROJETO

## O que é Laravel?

Laravel é um framework PHP moderno utilizado para desenvolvimento web.

Ele fornece:

* Estrutura organizada;
* Sistema de rotas;
* Segurança;
* ORM;
* Sistema de autenticação;
* Migrations;
* Templates;
* Integração com banco de dados.

Laravel foi escolhido porque:

* acelera o desenvolvimento;
* possui arquitetura moderna;
* facilita manutenção;
* possui grande comunidade.

---

## O que é PHP?

PHP é uma linguagem de programação focada em desenvolvimento web backend.

No projeto, o PHP é responsável por:

* processar regras;
* conectar ao banco;
* validar formulários;
* controlar autenticação;
* gerar páginas.

---

## O que é Blade?

Blade é o sistema de templates do Laravel.

Ele permite:

* misturar HTML com PHP;
* reutilizar layouts;
* criar componentes;
* organizar interfaces.

Exemplo:

```php
{{ $character->name }}
```

---

## O que é Tailwind CSS?

Tailwind é um framework CSS utilitário.

Ele permite estilizar usando classes prontas.

Exemplo:

```html
class="bg-amber-700 text-white rounded"
```

Foi escolhido porque:

* acelera design;
* facilita responsividade;
* mantém consistência visual.

---

## O que é MySQL?

MySQL é o banco de dados do sistema.

Ele armazena:

* usuários;
* personagens;
* itens;
* armas;
* magias;
* habilidades.

---

## O que é Composer?

Composer é o gerenciador de dependências PHP.

Ele instala bibliotecas utilizadas pelo Laravel.

Exemplo:

```bash
composer install
```

---

## O que é npm?

npm é o gerenciador de pacotes JavaScript.

Ele instala:

* Tailwind;
* Vite;
* bibliotecas frontend.

Exemplo:

```bash
npm install
```

---

## O que é Node.js?

Node.js permite executar JavaScript fora do navegador.

Ele é necessário para:

* Vite;
* Tailwind;
* npm.

---

## O que é Vite?

Vite é a ferramenta que compila frontend.

Ele atualiza automaticamente:

* CSS;
* JavaScript;
* Tailwind.

Comando:

```bash
npm run dev
```

---

## O que é Artisan?

Artisan é a ferramenta de linha de comando do Laravel.

Ela permite:

* criar controllers;
* criar migrations;
* limpar cache;
* rodar servidor;
* executar comandos do framework.

Exemplos:

```bash
php artisan serve
```

```bash
php artisan migrate
```

```bash
php artisan optimize:clear
```

---

## O que é uma Migration?

Migration é um arquivo que cria ou altera tabelas do banco.

Ela funciona como controle de versão do banco de dados.

Exemplo:

```php
$table->string('name');
```

---

## O que é um Controller?

Controller controla regras do sistema.

Exemplo:

* salvar personagem;
* validar formulário;
* redirecionar páginas.

---

## O que é um Model?

Model representa uma tabela do banco.

Exemplo:

```php
Character
```

representa:

```text
characters
```

---

## O que é uma Route?

Routes definem URLs do sistema.

Exemplo:

```php
Route::get('/characters', ...)
```

---

## Organização do projeto

### app/

Lógica principal.

### resources/views/

Telas do sistema.

### routes/

Rotas.

### database/

Banco e migrations.

### public/

Arquivos públicos.

### storage/

Arquivos temporários e uploads.

---

## Git e GitHub

### Git

Sistema de versionamento.

Permite:

* salvar histórico;
* voltar versões;
* trabalhar em equipe.

### GitHub

Plataforma online para hospedar repositórios Git.

---

## Comandos importantes do projeto

### Rodar servidor

```bash
php artisan serve
```

### Rodar frontend

```bash
npm run dev
```

### Limpar cache

```bash
php artisan optimize:clear
```

### Criar migration

```bash
php artisan make:migration
```

### Criar controller

```bash
php artisan make:controller
```

### Executar migrations

```bash
php artisan migrate
```

### Instalar dependências

```bash
composer install
npm install
```

---

# Conclusão

O Grimório RPG foi construído utilizando tecnologias modernas de desenvolvimento web, com foco em organização, expansão futura e experiência imersiva para jogadores de RPG.

A arquitetura do projeto permite adicionar novas funcionalidades futuramente de forma modular e organizada.
