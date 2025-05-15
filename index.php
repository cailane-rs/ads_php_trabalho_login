<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro usuário</title>
</head>
<body>

    <form id="formCadastro" action="cadastro.php" method="POST" onsubmit="return validarFormulario()">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <input id="idSenha" type="password" name="senha" placeholder="Senha" required>
        <input type="submit" value="Cadastrar">
    </form>

    <a href="login">Logar-se</a>

    <script>
        async function hashString(string) {
            const encoder = new TextEncoder();
            const data = encoder.encode(string);
            const hashBuffer = await crypto.subtle.digest('SHA-256', data);
            const hashArray = Array.from(new Uint8Array(hashBuffer));
            return hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
        }

        document.getElementById("formCadastro").addEventListener("submit", async function(e) {
            e.preventDefault(); // Impede o envio até o hash ser feito

            const senhaInput = document.getElementById("idSenha");

            if (senhaInput.value.length < 8) {
                alert("A senha deve ter pelo menos 8 caracteres.");
                return;
            }

            const senhaHash = await hashString(senhaInput.value);
            senhaInput.value = senhaHash; // Substitui a senha original pelo hash

            this.submit(); // Agora envia o formulário com a senha já em hash
        });

        function validaEmail(email) {
            const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return pattern.test(email);
        }

        function validarFormulario() {
            const email = document.getElementById("Idemail").value;
            if (!validaEmail(email)) {
                window.alert("Email inválido!");
                return false;
            }
            return true;
        }
    </script>

</body>
</html>


