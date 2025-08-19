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

## 🗄️ Esquema do Banco de Dados

### Tabelas Principais

#### **Autor**
```sql
CREATE TABLE Autor (
    CodAu BIGINT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(40) NOT NULL
);
```

#### **Livro**
```sql
CREATE TABLE Livro (
    Codl BIGINT PRIMARY KEY AUTO_INCREMENT,
    Titulo VARCHAR(40) NOT NULL,
    Editora VARCHAR(40) NOT NULL,
    Edicao INTEGER NOT NULL,
    AnoPublicacao VARCHAR(4) NOT NULL,
    Valor INTEGER NOT NULL  -- Valor em centavos
);
```

#### **Assunto**
```sql
CREATE TABLE Assunto (
    codAs BIGINT PRIMARY KEY AUTO_INCREMENT,
    Descricao VARCHAR(20) NOT NULL
);
```

### Tabelas de Relacionamento

#### **Livro_Autor** (Many-to-Many)
```sql
CREATE TABLE Livro_Autor (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    Livro_Codl BIGINT NOT NULL,
    Autor_CodAu BIGINT NOT NULL,
    FOREIGN KEY (Livro_Codl) REFERENCES Livro(Codl) ON DELETE CASCADE,
    FOREIGN KEY (Autor_CodAu) REFERENCES Autor(CodAu) ON DELETE CASCADE
);
```

#### **Livro_Assunto** (Many-to-Many)
```sql
CREATE TABLE Livro_Assunto (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    Livro_Codl BIGINT NOT NULL,
    Assunto_codAs BIGINT NOT NULL,
    FOREIGN KEY (Livro_Codl) REFERENCES Livro(Codl) ON DELETE CASCADE,
    FOREIGN KEY (Assunto_codAs) REFERENCES Assunto(codAs) ON DELETE CASCADE
);
```

### View de Relatórios

#### **vw_relatorio_autor**
```sql
CREATE OR REPLACE VIEW vw_relatorio_autor AS
SELECT 
    a.CodAu AS autor_id,
    a.Nome AS autor_nome,
    COUNT(DISTINCT l.Codl) AS total_livros,
    SUM(l.Valor) AS total_valor,
    COUNT(DISTINCT las.Assunto_codAs) AS total_assuntos,
    AVG(l.Valor) AS media_valor
FROM Autor a
JOIN Livro_Autor la ON a.CodAu = la.Autor_CodAu
JOIN Livro l ON la.Livro_Codl = l.Codl
LEFT JOIN Livro_Assunto las ON l.Codl = las.Livro_Codl
GROUP BY a.CodAu, a.Nome;
```

### Relacionamentos

```
┌─────────────┐       ┌─────────────────┐       ┌─────────────┐
│    Autor    │       │   Livro_Autor   │       │    Livro    │
├─────────────┤       ├─────────────────┤       ├─────────────┤
│ CodAu (PK)  │◄─────►│ Autor_CodAu(FK) │       │ Codl (PK)   │
│ Nome        │       │ Livro_Codl (FK) │◄─────►│ Titulo      │
└─────────────┘       └─────────────────┘       │ Editora     │
                                                │ Edicao      │
                                                │ AnoPublicacao│
                                                │ Valor       │
                                                └─────────────┘
                                                       ▲
                                                       │
                                                       ▼
                      ┌─────────────┐       ┌─────────────────┐
                      │   Assunto   │       │ Livro_Assunto   │
                      ├─────────────┤       ├─────────────────┤
                      │ codAs (PK)  │◄─────►│Assunto_codAs(FK)│
                      │ Descricao   │       │ Livro_Codl (FK) │
                      └─────────────┘       └─────────────────┘
```

### Características do Schema

- **Relacionamentos Many-to-Many**: Um livro pode ter múltiplos autores e um autor pode ter múltiplos livros
- **Relacionamentos Many-to-Many**: Um livro pode ter múltiplos assuntos e um assunto pode estar em múltiplos livros
- **Integridade Referencial**: Cascade delete para manter consistência
- **View Otimizada**: `vw_relatorio_autor` para estatísticas agregadas dos widgets
- **Valores Monetários**: Armazenados em centavos (INTEGER) para precisão

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

## 📝 Licença

Este projeto está licenciado sob a [MIT License](https://opensource.org/licenses/MIT).

---