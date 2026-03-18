<?php
session_start();

$ldap_server = "ldap://192.168.0.34";
$ldap_port = 389;
$domain = "gacc.local";
$grupo_permitido = "NTW_TI";

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $ldap = ldap_connect($ldap_server, $ldap_port);

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $bind = @ldap_bind($ldap, $user . "@" . $domain, $pass);

    if ($bind) {
        $base_dn = "DC=gacc,DC=local";
        $filter = "(sAMAccountName=$user)";

        $result = ldap_search($ldap, $base_dn, $filter);
        $entries = ldap_get_entries($ldap, $result);

        $permitido = false;

        if (isset($entries[0]["memberof"])) {
            $grupos = $entries[0]["memberof"];

            for ($i = 0; $i < $grupos["count"]; $i++) {
                if (strpos($grupos[$i], "CN=" . $grupo_permitido) !== false) {
                    $permitido = true;
                    break;
                }
            }
        }

        if ($permitido) {
            $_SESSION['user'] = $user;
            header("Location: home.php");
            exit;
        } else {
            $msg = "Usuário não pertence ao grupo NTW_TI";
        }

    } else {
        $msg = "Usuário ou senha inválidos";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Login - Painel TI</title>
<link rel="stylesheet" href="css/style-login.css">
</head>
<body>

<div class="login-card">
    <h1>Painel de Infraestrutura</h1>
    <form method="post">
        <input type="text" name="user" placeholder="Usuário" required>
        <input type="password" name="pass" placeholder="Senha" required>
        <button type="submit">Entrar</button>
        <?php if($msg){ ?>
            <p class="erro"><?php echo $msg ?></p>
        <?php } ?>
    </form>
    <a href="#">Esqueci minha senha</a>
</div>

</body>
</html>