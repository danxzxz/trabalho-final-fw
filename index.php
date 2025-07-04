<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Formulário de Conexão</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="container">

<form method="POST" action="creator.php">
    <?php

    include 'mensagens.php';
    if (isset($_GET['msg']) ){
        echo "<div id='mensagem'>" . ($mensagens[$_GET['msg']] ?? "Erro desconhecido") . "</div>";
    }
    ?>
    <h1>EasyMVC</h1><h2>Configuração</h2>

    <label for="servidor">Servidor:</label>
    <input type="text" id="servidor" name="servidor" required>

    <label for="usuario">Usuário:</label>
    <input type="text" id="usuario" name="usuario" required>

    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha">

    <label for="banco">Banco de Dados:</label>
    <select id="banco" name="banco" required>
        <option value="">Selecione o banco</option>
    </select>
    <button type="button" id="carregarBancos">Carregar Bancos</button>

    <button type="submit">Enviar</button>
</form>
</div>
<script>
document.getElementById('carregarBancos').addEventListener('click', function () {
    const servidor = document.getElementById('servidor').value;
    const usuario = document.getElementById('usuario').value;
    const senha = document.getElementById('senha').value;

    if (!servidor || !usuario) {
        alert('Preencha os campos de servidor e usuário antes de carregar os bancos.');
        return;
    }

    fetch('creator.php?action=listDatabases', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ servidor, usuario, senha })
    })
    .then(response => response.json())
    .then(data => {
        const selectBanco = document.getElementById('banco');
        selectBanco.innerHTML = '<option value="">Selecione o banco</option>';
        if (Array.isArray(data)) {
            data.forEach(banco => {
                const option = document.createElement('option');
                option.value = banco;
                option.textContent = banco;
                selectBanco.appendChild(option);
            });
        } else if (data.error) {
            alert(data.error);
        }
    })
    .catch(error => {
        console.error('Erro ao carregar bancos:', error);
        alert('Erro ao carregar bancos de dados. Verifique as credenciais.');
    });
});
</script>
</body>
</html>
