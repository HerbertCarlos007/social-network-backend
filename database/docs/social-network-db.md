## Tabela: Users

| Campo      | Tipo      | Chave | Obrigatório | Descrição                       |
|------------|-----------|-------|-------------|---------------------------------|
| id         | INT       | PK    | Sim         | Identificador único             |
| name       | STRING    | -     | Sim         | Nome do usuário                 |
| email      | STRING    | ÚNICO | Sim         | Email do usuário                |
| avatar_url | STRING    | -     | Não         | Foto do usuário                 |
| password   | STRING    | -     | Sim         | Senha do usuário                |
| created_at | TIMESTAMP | -     | Sim         | Data de criação do registro     |
| updated_at | TIMESTAMP | -     | Sim         | Data de atualização do registro |

## Tabela: Posts

| Campo          | Tipo      | Chave | Obrigatório | Descrição                       |
|----------------|-----------|-------|-------------|---------------------------------|
| id             | INT       | PK    | Sim         | Identificador único             |
| user_id        | INT       | FK    | Sim         | Identificador do usuário        |
| content        | STRING    | -     | Sim         | Conteudo do post                |
| image_post_url | STRING    | -     | Não         | Imagem do post                  |
| created_at     | TIMESTAMP | -     | Sim         | Data de criação do registro     |
| updated_at     | TIMESTAMP | -     | Sim         | Data de atualização do registro |

## Tabela: Comments

| Campo      | Tipo      | Chave | Obrigatório | Descrição                       |
|------------|-----------|-------|-------------|---------------------------------|
| id         | INT       | PK    | Sim         | Identificador único             |
| post_id    | INT       | FK    | Sim         | Identificador do post           |
| user_id    | INT       | FK    | Sim         | Identificador do usuário        |
| content    | STRING    | -     | Sim         | Imagem do post                  |
| created_at | TIMESTAMP | -     | Sim         | Data de criação do registro     |
| updated_at | TIMESTAMP | -     | Sim         | Data de atualização do registro |

## Tabela: Likes

| Campo      | Tipo      | Chave | Obrigatório | Descrição                       |
|------------|-----------|-------|-------------|---------------------------------|
| id         | INT       | PK    | Sim         | Identificador único             |
| post_id    | INT       | FK    | Sim         | Identificador do post           |
| user_id    | INT       | FK    | Sim         | Identificador do usuário        |
| created_at | TIMESTAMP | -     | Sim         | Data de criação do registro     |
| updated_at | TIMESTAMP | -     | Sim         | Data de atualização do registro |

## Tabela: Friendships

| Campo      | Tipo      | Chave | Obrigatório | Descrição                       |
|------------|-----------|-------|-------------|---------------------------------|
| id         | INT       | PK    | Sim         | Identificador único             |
| user_id    | INT       | FK    | Sim         | Identificador do usuário        |
| friend_id  | INT       | FK    | Sim         | Identificador do amigo          |
| status     | ENUM      | -     | SIM         | Status da amizade               |
| created_at | TIMESTAMP | -     | Sim         | Data de criação do registro     |
| updated_at | TIMESTAMP | -     | Sim         | Data de atualização do registro |
