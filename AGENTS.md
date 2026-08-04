Você é o desenvolvedor responsável por este projeto.

Antes de modificar qualquer arquivo, leia todo o projeto e entenda sua arquitetura.

# PROJETO

Nome:
Grimório RPG

Objetivo:

Desenvolver uma plataforma web para jogadores de RPG de mesa (D&D 5e inicialmente) onde os usuários podem:

• criar fichas completas
• editar fichas
• compartilhar fichas
• organizar campanhas futuramente
• manter um diário de aventuras
• registrar equipamentos
• registrar magias
• registrar habilidades
• registrar aparência
• controlar moedas
• controlar pontos de vida
• controlar inspiração
• controlar inventário

O projeto NÃO é apenas um CRUD.

A intenção é transformá-lo em uma plataforma colaborativa para grupos de RPG.

----------------------------------------------------

TECNOLOGIAS

Laravel 13
PHP 8.3
MySQL
Blade
TailwindCSS
Vite
JavaScript
Eloquent ORM

----------------------------------------------------

ESTILO VISUAL

Todo o projeto utiliza identidade visual inspirada em um livro medieval.

Não utilizar Bootstrap.

Utilizar Tailwind.

As páginas devem parecer páginas de um grimório.

Características:

• pergaminho
• couro
• dourado
• roxo
• madeira
• aparência de livro antigo

Toda nova tela deve seguir esse padrão.

----------------------------------------------------

ORGANIZAÇÃO

Sempre manter o padrão Laravel.

Controllers pequenos.

Models responsáveis pelas regras de negócio.

Blade organizada.

Evitar duplicação.

Sempre reutilizar componentes.

Sempre utilizar Eloquent.

----------------------------------------------------

REGRAS IMPORTANTES

Nunca alterar:

.env

Nunca executar:

migrate:fresh

Nunca apagar migrations.

Nunca apagar tabelas.

Nunca executar git push.

Nunca remover funcionalidades existentes.

Sempre preservar compatibilidade com o banco atual.

----------------------------------------------------

COMPARTILHAMENTO

O projeto possui compartilhamento de personagens.

Existem três níveis de acesso.

PROPRIETÁRIO

Pode:

✓ visualizar
✓ editar
✓ excluir
✓ compartilhar

EDITOR

Pode:

✓ visualizar
✓ editar

Não pode:

✗ excluir
✗ compartilhar

VISUALIZADOR

Pode:

✓ visualizar

Não pode:

✗ editar
✗ excluir
✗ compartilhar

Todo controller deve obedecer estas regras.

Consultar:

canView()

canEdit()

isOwner()

canManageShares()

Nunca utilizar:

user_id == Auth::id()

Nem:

authorizeCharacter()

Esses padrões antigos estão sendo removidos.

----------------------------------------------------

ESTADO ATUAL DO PROJETO

Já implementado:

✓ Login personalizado
✓ Dashboard personalizado
✓ Listagem personalizada
✓ Criação de personagem
✓ Edição
✓ Upload de retrato
✓ Exibição do retrato
✓ Aparência personalizada
✓ Equipamentos
✓ Arsenal
✓ Grimório
✓ Idiomas
✓ Habilidades
✓ Compartilhamento de fichas
✓ Permissões de compartilhamento
✓ Compartilhamento salvo em banco
✓ Listagem de fichas compartilhadas

Em andamento:

Migração de todos os controllers para utilizar:

canView()

canEdit()

isOwner()

No lugar das verificações antigas.

----------------------------------------------------

FORMA DE TRABALHO

Antes de modificar qualquer arquivo:

1) Analise o projeto.

2) Explique o plano.

3) Liste exatamente quais arquivos serão modificados.

4) Aguarde minha aprovação.

Somente depois faça alterações.

Após modificar:

• explique o que mudou

• explique por quê

• informe possíveis impactos

• informe testes recomendados

----------------------------------------------------

QUALIDADE

Prefiro soluções:

• limpas

• reutilizáveis

• orientadas a objetos

• seguindo SOLID quando possível

• seguindo convenções Laravel

Evite código duplicado.

Evite funções enormes.

Prefira métodos pequenos.

----------------------------------------------------

OBJETIVO FUTURO

Após finalizar o compartilhamento implementaremos:

• Campanhas

• Diário de Sessões

• Compartilhamento do diário entre jogadores

• Histórico de aventuras

• NPCs

• Bestiário

• Mapa da campanha

• Anotações do Mestre

• Dashboard da campanha

Essas futuras funcionalidades devem ser consideradas na arquitetura sempre que possível.

----------------------------------------------------

INSTRUÇÃO FINAL

Sempre que eu solicitar uma alteração:

1) primeiro analise;

2) proponha um plano;

3) só depois implemente.

Nunca faça alterações grandes sem apresentar o plano antes.
