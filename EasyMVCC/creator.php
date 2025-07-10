<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

if (isset($_GET['action']) && $_GET['action'] === 'listDatabases') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (
        !empty(trim($input['servidor'] ?? '')) &&
        !empty(trim($input['usuario'] ?? '')) &&
        isset($input['senha'])
    ) {
        $servidor = $input['servidor'];
        $usuario = $input['usuario'];
        $senha = $input['senha'];
        try {
            $pdo = new PDO("mysql:host=$servidor", $usuario, $senha);
            $stmt = $pdo->query("SHOW DATABASES");
            $bancos = $stmt->fetchAll(PDO::FETCH_COLUMN);
            header('Content-Type: application/json');
            echo json_encode($bancos);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => 'Falha ao conectar ao servidor MySQL']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Dados incompletos']);
    }
    exit;
}

class Creator {
    private $con;
    private $servidor;
    private $banco;
    private $usuario;
    private $senha;
    private $tabelas;

    function __construct() {
        $this->criaDiretorios();
        $this->conectar();
        $this->buscaTabelas();
        $this->ClassesModel();
        $this->ClasseConexao();
        $this->ClassesControl();
        $this->ClassesView();
        $this->compactar();
        header("Location: index.php?msg=2");
    }

    function criaDiretorios() {
        $dirs = [
            "sistema",
            "sistema/model",
            "sistema/control",
            "sistema/view",
            "sistema/dao",
            "sistema/css"
        ];

        foreach ($dirs as $dir) {
            if (!file_exists($dir)) {
                if (!mkdir($dir, 0777, true)) {
                    header("Location: index.php?msg=0");
                    exit;
                }
            }
        }
        $css = <<<EOT
body {
    font-family: Arial, sans-serif;
    background: #f2f2f2;
}
form {
    background: #fff;
    padding: 20px 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    width: 300px;
}
input, select, button {
    margin-top: 10px;
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
}
button {
    background: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
button:hover {
    background: #45a049;
}
EOT;
        file_put_contents("sistema/css/estilos.css", $css);
    }

    function conectar() {
        $this->servidor = $_POST["servidor"];
        $this->banco = $_POST["banco"];
        $this->usuario = $_POST["usuario"];
        $this->senha = $_POST["senha"];
        try {
            $this->con = new PDO(
                "mysql:host=" . $this->servidor . ";dbname=" . $this->banco,
                $this->usuario,
                $this->senha
            );
        } catch (Exception $e) {
            header("Location: index.php?msg=1");
            exit;
        }
    }

    function buscaTabelas() {
        try {
            $sql = "SHOW TABLES";
            $query = $this->con->query($sql);
            $this->tabelas = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            header("Location: index.php?msg=3");
            exit;
        }
    }

    function buscaAtributos($nomeTabela) {
        $sql = "SHOW COLUMNS FROM " . $nomeTabela;
        $atributos = $this->con->query($sql)->fetchAll(PDO::FETCH_OBJ);
        return $atributos;
    }

    function ClassesModel() {
        foreach ($this->tabelas as $tabela) {
            $nomeTabela = array_values((array) $tabela)[0];
            $atributos = $this->buscaAtributos($nomeTabela);
            $nomeAtributos = "";
            $geters_seters = "";
            foreach ($atributos as $atributo) {
                $atributo = $atributo->Field;
                $nomeAtributos .= "\tprivate \${$atributo};\n";
                $metodo = ucfirst($atributo);
                $geters_seters .= "\tfunction get" . $metodo . "(){\n";
                $geters_seters .= "\t\treturn \$this->{$atributo};\n\t}\n";
                $geters_seters .= "\tfunction set" . $metodo . "(\${$atributo}){\n";
                $geters_seters .= "\t\t\$this->{$atributo}=\${$atributo};\n\t}\n";
            }
            $nomeTabela = ucfirst($nomeTabela);
            $conteudo = <<<EOT
<?php
class {$nomeTabela} {
{$nomeAtributos}
{$geters_seters}
}
?>
EOT;
            file_put_contents("sistema/model/{$nomeTabela}.php", $conteudo);
        }
    }

    function ClasseConexao() {
        $conteudo = <<<EOT
<?php
class Conexao {
    private \$server;
    private \$banco;
    private \$usuario;
    private \$senha;
    function __construct() {
        \$this->server = '[Informe aqui o servidor]';
        \$this->banco = '[Informe aqui o seu Banco de dados]';
        \$this->usuario = '[Informe aqui o usuário do banco de dados]';
        \$this->senha = '[Informe aqui a senha do banco de dados]';
    }
    function conectar() {
        try {
            \$conn = new PDO(
                "mysql:host=" . \$this->server . ";dbname=" . \$this->banco,\$this->usuario,
                \$this->senha
            );
            return \$conn;
        } catch (Exception \$e) {
            echo "Erro ao conectar com o Banco de dados: " . \$e->getMessage();
        }
    }
}
?>
EOT;
        file_put_contents("sistema/model/conexao.php", $conteudo);
    }

    function ClassesControl() {
        foreach ($this->tabelas as $tabela) {
            $nomeTabela = array_values((array) $tabela)[0];
            $nomeClasse = ucfirst($nomeTabela);
            $conteudo = <<<EOT
<?php
require_once("../model/{$nomeClasse}.php");
require_once("../dao/{$nomeClasse}Dao.php");
class {$nomeClasse}Control {
    private \${$nomeTabela};
    private \$acao;
    private \$dao;
    public function __construct(){
       \$this->{$nomeTabela}=new {$nomeClasse}();
      \$this->dao=new {$nomeClasse}Dao();
      \$this->acao=\$_GET["a"];
      \$this->verificaAcao(); 
    }
    function verificaAcao(){}
    function inserir(){}
    function excluir(){}
    function alterar(){}
    function buscarId({$nomeClasse} \${$nomeTabela}){}
    function buscaTodos(){}
}
new {$nomeClasse}Control();
?>
EOT;
            file_put_contents("sistema/control/{$nomeTabela}Control.php", $conteudo);
        }
    }

    function ClassesView() {
        foreach ($this->tabelas as $tabela) {
            $nomeTabela = array_values((array) $tabela)[0];
            $atributos = $this->buscaAtributos($nomeTabela);
            $campos = "";
            foreach ($atributos as $atributo) {
                if ($atributo->Key === "PRI") continue; 
                $type = (stripos($atributo->Type, 'int') !== false) ? 'number' : 'text';
                $campos .= "<label for='{$atributo->Field}'>{$atributo->Field}:</label>\n";
                $campos .= "<input type='{$type}' name='{$atributo->Field}' id='{$atributo->Field}' required>\n";
            }
            $form = <<<EOT
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Cadastro de {$nomeTabela}</title>
</head>
<body>
<form method="POST" action="">
    {$campos}
    <button type="submit">Enviar</button>
</form>
</body>
</html>
EOT;
            file_put_contents("sistema/view/{$nomeTabela}Form.php", $form);
        }
    }

    function compactar() {
        $folderToZip = 'sistema';
        $outputZip = 'sistema.zip';
        $zip = new ZipArchive();
        if ($zip->open($outputZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            header("Location: index.php?msg=0");
            exit;
        }
        $folderPath = realpath($folderToZip);
        if (!is_dir($folderPath)) {
            header("Location: index.php?msg=0");
            exit;
        }
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($folderPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($folderPath) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
    }
}

new Creator();