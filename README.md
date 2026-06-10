# 💈 Control Barber - Sistema de Gestão de Barbearia

O **Control Barber** é uma aplicação web completa desenvolvida para automatizar e gerenciar o fluxo de atendimento de uma barbearia. O sistema permite o controlo total de barbeiros, clientes e serviços através de uma interface administrativa segura, responsiva e de alta performance.

---

## 🚀 Tecnologias Utilizadas

* **Backend:** PHP 8.2 (Modular e Estruturado)
* **Banco de Dados:** MySQL 8.0 (Persistência relacional)
* **Frontend:** HTML5, CSS3, JavaScript (Vanilla JS) e Bootstrap 5.3
* **Infraestrutura:** Docker & Docker-Compose (Isolamento de ambiente)

---

## 📦 Arquitetura de Infraestrutura (Docker)

O projeto foi totalmente conteinerizado para garantir consistência entre ambientes de desenvolvimento e produção. 

* **`Dockerfile`**: Baseado na imagem oficial do `php:8.2-apache`, habilitando o módulo de reescrita do Apache (`a2enmod rewrite`) e instalando extensões nativas (`gd`, `pdo_mysql`) para o processamento e upload seguro de imagens.
* **`docker-compose.yml`**: Orquestra dois serviços:
    1.  `app`: Servidor web mapeado na porta `8080`.
    2.  `db`: Banco de dados MySQL na porta `3306`, configurado com `healthcheck` para garantir que o servidor Apache só inicie após o banco estar totalmente pronto para receber conexões.

---

## 🛡️ Engenharia de Segurança Aplicada

1.  **Proteção contra SQL Injection:** Toda a comunicação com a base de dados utiliza **PDO (PHP Data Objects)** com **Prepared Statements**. Os dados nunca são concatenados diretamente na consulta, impedindo a injeção de scripts maliciosos.
2.  **Prevenção contra XSS (Cross-Site Scripting):** Na renderização de dados vindos do utilizador, é aplicada a função `htmlspecialchars()`, convertendo caracteres como `<` e `>` em entidades seguras de texto.
3.  **Sanitização Estrita de Inputs:** Filtros avançados com Expressões Regulares (`preg_replace('/\D/', '', $telefone)`) limpam dados antes da inserção, garantindo a integridade do banco.
4.  **Upload Seguro de Ficheiros:** Validação por *whitelist* de extensões (`jpg`, `png`, `webp`) e criptografia do nome do arquivo com hash `md5()` combinado ao *timestamp* atual (`time()`), eliminando colisões de ficheiros e vulnerabilidades de *Directory Traversal*.

---

## 🧠 Explicação Detalhada do Código Técnico

### 1. O Motor de Busca em Tempo Real (JavaScript)
Para evitar requisições desnecessárias ao banco de dados e dar uma experiência instantânea ao utilizador, o sistema utiliza uma varredura de DOM reativa no evento de input.

```javascript
document.getElementById('searchBarber').addEventListener('input', function() {
    let filter = this.value.toLowerCase();
    let cards = document.querySelectorAll('.barber-card');

    cards.forEach(function(card) {
        let name = card.querySelector('.card-title').textContent.toLowerCase();
        if (name.includes(filter)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
});
