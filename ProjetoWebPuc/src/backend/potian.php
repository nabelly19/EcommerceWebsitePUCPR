<?php
    //conectando ao meu BD

    $db_connection = mysqli_conect("localhost: 3306", "root", "1234", "potian_final");
    
        // Verificar a conexão
    if ($db_connection->connect_error) {
        die("Falha na conexão com o banco de dados: " . $db_connection->connect_error);
    }

    
    //Fazendo upload dos dados cadastrados dos produtos no BD

    $product_name = $_POST["name"];
    $product_price = $_POST["prices"];
    $product_stock = $_POST["stock"];

    $query_products_post = mysqli_query("INSERT INTO podutos(nome, estoque, valor) VALUES ('$product_name', '$product_price', '$product_stock')");


        //fazendo upload das imagens do produto para o BD
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $imagem = file_get_contents($_FILES["image"]["tmp_name"]);
    
        $query_sendImage = "INSERT INTO produto (imagem) VALUES ('$imagem')";
    
        if ($db_connection->query($query_sendImage) === true) {
            echo "Imagem enviada com sucesso.";
        } else {
            echo "Erro ao enviar a imagem: " . $db_connection->error;
        }
    }
    
    
    //pegando dados dos produtos para o card

    $query_get_products = mysqli_query($db_connection, "SELECT * FROM produtos");
    $product_data = array();

    while($registro = mysqli_fetch_assoc($resultado)){
        array_push($product_data, $registro);
    }

    $json_card = json_encode($product_data);
    echo $json_card; 
    
    
    //fazendo upload de cadastro novo

        // Função para verificar se o nome de usuário já existe

    // function isUsernameTaken($db_connection, $username_signIN) {
    //     $sql_isUserTaken = "SELECT e-mail FROM login WHERE e-mail = '$username_signIN'";
    //     $result = $db_connection->query($sql_isUserTaken);
    //     return $result->num_rows > 0;
    // }

        // Receber os dados do formulário

    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     $username_signIN = $_POST["username"]; //*no html os 'name's precisam ser esses para a senha e usuario
    //     $user_password = $_POST["user_password"];

        // Verificar se o nome de usuário já existe

        // if (isUsernameTaken($db_connection, $username_signIN)) {
        //     echo "Nome de usuário já existe. Escolha outro.";
        // } 
        
        // else {
            
            // Verificar se a senha atende aos critérios mínimos de segurança
        
            // if (strlen($user_password) < 6) {
            //     echo "A senha deve ter pelo menos 6 caracteres.";
            // } 

            // elseif (strlen($user_password) > 18) {
            //     echo "A senha deve ter menos de 19 caracteres.";
            // }
        
            // else {
            //     $user_password = password_hash($user_password, user_password_DEFAULT); // Criptografa a senha

            
                // Inserir os dados no banco de dados
            
    //         $sql_insert_login = "INSERT INTO login (e-mail, senha) VALUES ('$username_signIN', '$user_password')";

    //         if ($db_connection->query($sql_insert_login) === TRUE) {
    //             echo "Cadastro realizado com sucesso.";
    //         } else {
    //             echo "Erro: " . $sql_insert_login . "<br>" . $db_connection->error; //*dar echo nisso no html
    //             }
    //         }
    //     }
    // }


    //Validação de login
    
    $password_logIn = $_POST["senha"];
    $username_logIn = $_POST["edv"];
    
    $get_user = $db_connection->query("SELECT e-mail, senha FROM login WHERE e-mail = '$username'");

    if($get_user -> rows > 0) { // "->"é usado para acessar propriedades ou métodos de objetos
        $row = $result_get_user->fetch_assoc(); // retorna um array com os dados da coluna
        $hashed_password = $row["senha"];

            echo "Login bem-sucedido. Bem-vindo, $username!";
         else {
            echo "Senha incorreta. Por favor, tente novamente.";
        }
     else {
        echo "Nome de usuário não encontrado. Por favor, registre-se antes de fazer login.";
    }
}
    
    $db_connection->close();




//inacabado -->   if ($senha === $senha2) {
//        echo "Login bem-sucedido!";
//    } else {
//        echo "Credenciais inválidas. Tente novamente.";
//    }


//devo colocar em funções?
// a variavel username_signIn só é assim por conta de não ter funções, se não se chamaria apenas username


//parte do botão search
$search = $_POST['search'];
$stmt = $con->prepare("SELECT * FROM produtos WHERE nome LIKE ?");
$stmt->bind_param("s", $search);
$stmt->execute();


$result = $stmt->get_result();
$results = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($results);

$stmt->close();
$con->close();

?>
