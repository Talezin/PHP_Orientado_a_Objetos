<link rel="stylesheet" type="text/css" href="css/search.css">
<div class="formulario">
<form method="POST" action="php/cls.php">
        <input type="text" name="codigo" placeholder="Código">
            <h1>ou</h1>
            <select name="opcao">
                <option value="">Listar por...</option>
                <option value="codigo">Codigo</option>
                <option value="razaoSocial">Razão Social</option>
                <option value="nomeFantasia">Nome Fantasia</option>
                <option value="estadoTransp">Estado</option>
            </select>
            <input type="submit" name="botao" value="Pesquisar">
</form>
</div>
