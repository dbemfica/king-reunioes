## King Reuniões

Um sistema para gerenciamento de salas de reuniões usando PHP 7.1 e o framework Laravel 5.5

### Instruções
Copie o arquivo .env.example e o renomeia para .env

#### Banco de Dados
Configurações do banco de dados está no arquivo .env, o banco dados ultilizado foi o MySQL 5.7

#### Banco de Dados para os testes automatizados
- Sqlite

#### Usuário default
 Rode o comando

 ```php
php artisan db:seed
```
Isso vai criar um usuário com e-mail: 'admin@admin.com' e senha: 'root'

#### Teste automatizados
Rode o comando

 ```bash
vendor/bin/phpunit
```