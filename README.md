# 📚 Book Manager

Um sistema completo de gerenciamento de livros, autores e assuntos desenvolvido com Laravel e Filament. O sistema oferece uma interface administrativa moderna e intuitiva para catalogar e gerenciar uma biblioteca de livros.

## ✨ Principais Funcionalidades

### 📖 Gestão de Livros
- **CRUD Completo**: Criar, visualizar, editar e excluir livros
- **Informações Detalhadas**: Título, edição, ano de publicação, valor
- **Relacionamentos**: Associação com múltiplos autores e assuntos
- **Validações**: Campos obrigatórios e regras de negócio

### ✍️ Gestão de Autores
- **Perfil Completo**: Nome e informações dos autores
- **Estatísticas Avançadas**: Dashboards com métricas por autor
- **Relacionamentos**: Visualização de todos os livros do autor
- **Widgets Interativos**: Gráficos de barras com dados em tempo real

### 🏷️ Gestão de Assuntos
- **Categorização**: Organização por temas e assuntos
- **Relacionamentos**: Livros associados a cada assunto
- **Busca e Filtros**: Localização rápida de conteúdo

### 📊 Dashboard e Relatórios
- **Widgets de Estatísticas**: Gráficos interativos por autor
  - Livros por Autor
  - Valor Total por Autor
  - Assuntos por Autor
  - Média de Valor por Autor
- **Visualizações**: Interface moderna com Filament
- **Dados em Tempo Real**: Estatísticas atualizadas automaticamente

## 🛠️ Tecnologias Utilizadas

### Backend
- **[Laravel 12.x](https://laravel.com)** - Framework PHP moderno
- **[Filament 4.x](https://filamentphp.com)** - Painel administrativo
- **PHP 8.2+** - Linguagem de programação
- **MySQL 8.0** - Banco de dados relacional

### Frontend
- **[Livewire](https://livewire.laravel.com)** - Componentes dinâmicos
- **[Alpine.js](https://alpinejs.dev)** - Framework JavaScript leve
- **[Tailwind CSS](https://tailwindcss.com)** - Framework CSS utilitário
- **[Chart.js](https://www.chartjs.org)** - Gráficos interativos

### Desenvolvimento
- **[Vite](https://vitejs.dev)** - Build tool e bundler
- **[Pest](https://pestphp.com)** - Framework de testes
- **[Laravel Pint](https://laravel.com/docs/pint)** - Code style fixer
- **[Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)** - Debug toolbar

### DevOps
- **Docker & Docker Compose** - Containerização
- **Nginx** - Servidor web
- **Node.js 20** - Runtime JavaScript

## 🚀 Instalação

### Pré-requisitos
- Docker e Docker Compose

### Instalação com Docker

1. **Clone o repositório**
```bash
git clone <repository-url>
cd book-manager
```

2. **Construir e iniciar todos os serviços**
```bash
docker-compose up --build
```

3. **Acessar bash do container**
```bash
docker-compose exec app bash
```

4. **Executar migrações e seeders**
```bash
php artisan migrate --seed
```

5. **Executar testes**
```bash
./vendor/bin/pest
```

## 🗄️ Comandos de Banco de Dados

### Migrações
```bash
# Executar todas as migrações
php artisan migrate

# Executar migrações com dados de exemplo
php artisan migrate --seed

# Reverter última migração
php artisan migrate:rollback

# Reverter todas as migrações
php artisan migrate:reset

# Recriar banco do zero
php artisan migrate:fresh --seed
```

### Seeders
```bash
# Executar todos os seeders
php artisan db:seed

# Executar seeder específico
php artisan db:seed --class=AutorSeeder
php artisan db:seed --class=AssuntoSeeder
php artisan db:seed --class=LivroSeeder
```

### Factories
```bash
# Gerar dados de teste via Tinker
php artisan tinker

# Dentro do Tinker:
App\Models\Autor::factory(10)->create();
App\Models\Assunto::factory(5)->create();
App\Models\Livro::factory(20)->create();
```

## 🐳 Docker

### Configuração Docker

O projeto inclui configuração completa com Docker Compose:

- **app**: Aplicação Laravel (PHP 8.2 + Apache)
- **nginx**: Servidor web (porta 8000)
- **db**: MySQL 8.0 (porta 3306)
- **node**: Node.js 20 para assets (porta 5173)

### Comandos Docker

```bash
# Construir e iniciar todos os serviços
docker-compose up --build

# Acessar bash do container
docker-compose exec app bash

# Executar migrações e seeders
php artisan migrate --seed

# Executar testes
./vendor/bin/pest
```

### Acesso
- **Aplicação**: http://localhost:8000
- **MySQL**: localhost:3306
- **Vite Dev Server**: http://localhost:5173

## 📁 Estrutura de Classes Importantes

```
app/
├── Filament/
│   └── Resources/
│       └── Autores/
│           ├── AutorResource.php           # Resource principal dos autores
│           ├── Pages/
│           │   ├── CreateAutor.php         # Página de criação
│           │   ├── EditAutor.php           # Página de edição
│           │   ├── ListAutores.php         # Página de listagem
│           │   └── ViewAutor.php           # Página de visualização
│           ├── RelationManagers/
│           │   └── LivrosRelationManager.php # Gerenciador de livros do autor
│           ├── Schemas/
│           │   ├── AutorForm.php           # Schema do formulário
│           │   └── AutorInfolist.php       # Schema de informações
│           ├── Tables/
│           │   └── AutoresTable.php        # Configuração da tabela
│           └── Widgets/
│               ├── TotalBooksWidget.php    # Widget: Livros por autor
│               ├── TotalValueWidget.php    # Widget: Valor por autor
│               ├── TotalSubjectsWidget.php # Widget: Assuntos por autor
│               └── AverageValueWidget.php  # Widget: Média de valor
├── Models/
│   ├── Assunto.php                        # Model de Assunto
│   ├── Autor.php                          # Model de Autor
│   ├── Livro.php                          # Model de Livro
│   └── User.php                           # Model de Usuário
├── Repositories/
│   └── AutorRepository.php                # Repository para dados de autores
└── Services/
    └── AutorService.php                   # Service para lógica de negócio

database/
├── factories/
│   ├── AssuntoFactory.php                 # Factory para Assuntos
│   ├── AutorFactory.php                   # Factory para Autores
│   └── LivroFactory.php                   # Factory para Livros
└── seeders/
    ├── AssuntoSeeder.php                  # Seeder para Assuntos
    ├── AutorSeeder.php                    # Seeder para Autores
    ├── DatabaseSeeder.php                 # Seeder principal
    └── LivroSeeder.php                    # Seeder para Livros
```

## 🎯 Arquitetura

### Padrões Utilizados
- **Repository Pattern**: Abstração da camada de dados
- **Service Layer**: Lógica de negócio centralizada
- **Factory Pattern**: Geração de dados de teste
- **Resource Pattern**: Organização de recursos Filament

### Relacionamentos
- **Autor ↔ Livro**: Many-to-Many (um autor pode ter vários livros, um livro pode ter vários autores)
- **Livro ↔ Assunto**: Many-to-Many (um livro pode ter vários assuntos, um assunto pode estar em vários livros)

### Funcionalidades Especiais
- **View Materializada**: `vw_relatorio_autor` para estatísticas otimizadas
- **Widgets Dinâmicos**: Gráficos Chart.js integrados com Filament
- **Cache de Dados**: Repository com cache para melhor performance
- **Validações Customizadas**: Regras de negócio específicas

## 🧪 Testes

```bash
# Executar todos os testes
php artisan test

# Executar testes com coverage
php artisan test --coverage

# Executar testes específicos
php artisan test --filter=AutorTest
```

## 📝 Licença

Este projeto está licenciado sob a [MIT License](https://opensource.org/licenses/MIT).

---