# 🎯 Taskflow com IA



<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=flat&logo=laravel&logoColor=white" alt="Laravel 12" />
  <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=flat&logo=php&logoColor=white" alt="PHP 8.2" />
  <img src="https://img.shields.io/badge/Tailwind-4.0-06B6D4?style=flat&logo=tailwindcss&logoColor=white" alt="Tailwind 4" />
  <img src="https://img.shields.io/badge/Licença-MIT-green.svg" alt="Licença MIT" />
</p>

---

## 📋 Sobre o Projeto

**Taskflow com IA** é um gerenciador de tarefas no estilo Kanban que utiliza inteligência artificial para priorizar automaticamente suas atividades. Com uma interface **Liquid Glass** elegante e animações fluidas, o sistema analisa suas tarefas e sugere prioridades estratégicas baseadas em impacto e urgência.

A IA (via **Groq API** com modelo **LLaMA 3.3 70B**) atua como um Tech Lead experiente, avaliando cada tarefa do backlog e classificando-as em Alta, Média ou Baixa prioridade, junto com insights sobre a decisão.

---

## ✨ Recursos Principais

✅ **Quadro Kanban Interativo**
- Arrastar e soltar fluido entre colunas (A Fazer → Em Progresso → Concluído)
- Contadores em tempo real
- Animações suaves com transições CSS

✅ **IA para Priorização Automática**
- Analisa título e descrição de cada tarefa
- Classifica com base em impacto sistêmico e bloqueio
- Fornece raciocínio estratégico

✅ **Design Liquid Glass**
- Glassmorphism com efeito de desfoque
- Paleta de cores harmoniosa (âmbar/laranja)
- Totalmente responsivo

✅ **Gestão Completa de Tarefas**
- Criação rápida com prioridade manual
- Edição inline
- Exclusão com confirmação

---

## 🛠️ Tecnologias Utilizadas

### Backend
- **Laravel 12** - Framework PHP moderno
- **PHP 8.2** - Linguagem de programação
- **SQLite** - Banco de dados leve

### Frontend
- **Tailwind CSS 4** - Framework CSS utility-first
- **Vite** - Ferramenta de build e servidor de desenvolvimento
- **SortableJS** - Biblioteca de arrastar e soltar

### Inteligência Artificial
- **Groq API** - Infraestrutura de inferência rápida
- **LLaMA 3.3 70B Versatile** - Modelo de linguagem

---

## 📦 Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- **PHP** >= 8.2
- **Composer** (gerenciador de dependências PHP)
- **Node.js** >= 18 e **NPM**
- **Conta Groq** (gratuita) para obter a chave da API

---

## 🚀 Instalação

### 1. Clone o Repositório

```bash
git clone https://github.com/seu-usuario/taskflow-ia.git
cd taskflow-ia
```

### 2. Instale as Dependências

```bash
# Dependências PHP
composer install

# Dependências Node
npm install
```

### 3. Configure o Ambiente

```bash
# Copie o arquivo de exemplo
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate
```

### 4. Configure a Chave da API Groq

Edite o arquivo `.env` e adicione sua chave:

```env
GROQ_API_KEY=sua_chave_aqui
```

> **Como obter a chave Groq:**
> 1. Acesse [console.groq.com](https://console.groq.com)
> 2. Crie uma conta gratuita
> 3. Vá em **API Keys** e gere uma nova chave
> 4. Cole no arquivo `.env`

### 5. Execute as Migrações

```bash
php artisan migrate
```

### 6. Inicie o Servidor

```bash
# Usando o script composer (recomendado)
composer run dev

# OU manualmente em terminais separados:
php artisan serve
npm run dev
```

Acesse: **http://localhost:8000**

---

## 📖 Como Usar

### Criar uma Tarefa
1. Preencha os campos no topo (Título, Descrição, Prioridade)
2. Clique em **+ Adicionar**
3. A tarefa aparecerá na coluna "A Fazer"

### Organizar com IA
1. Clique no botão **"Deixar a IA organizar"**
2. Aguarde alguns segundos
3. As tarefas serão automaticamente repriorizadas
4. Veja o insight estratégico exibido no topo

### Mover Tarefas
- Arraste pelo ícone de **grip** (⁞⁞) no lado esquerdo do card
- Solte na coluna desejada
- Os contadores atualizam instantaneamente

### Editar/Excluir
- Passe o mouse sobre um card
- Clique no ícone de **lápis** para editar
- Clique na **lixeira** para excluir

---

## 🎨 Capturas de Tela

_Adicione aqui capturas de tela da interface do projeto_

---

## 🤖 Personalização da IA

### Alterar o Modelo

Edite `app/Services/AIService.php` na linha 54:

```php
'model' => 'llama-3.3-70b-versatile', // Troque por outro modelo Groq
```

Modelos disponíveis: [Lista de Modelos Groq](https://console.groq.com/docs/models)

### Ajustar os Prompts

Modifique as variáveis `$systemPrompt` e `$userPrompt` no mesmo arquivo para alterar o comportamento da IA.

---

## 📄 Licença

Este projeto está sob a licença **MIT**. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

---

## 🙏 Créditos

- **Laravel Framework** - [laravel.com](https://laravel.com)
- **Groq** - Infraestrutura de IA ultrarrápida
- **SortableJS** - Biblioteca de arrastar e soltar
- **Tailwind CSS** - Framework CSS

---

<p align="center">
  Feito com ❤️ e IA
</p>
