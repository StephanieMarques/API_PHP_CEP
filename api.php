<?php
// Verifica se o CEP foi enviado via GET
if (isset($_GET['cep'])) {
    $cep = $_GET['cep'];
 
    // Remove qualquer caractere especial do CEP
    $cep = preg_replace('/[^0-9]/', '', $cep);
 
    // Valida se o CEP tem 8 dígitos
    if (strlen($cep) == 8) {
        // URL da API que será usada para consultar o CEP
        $url = "https://viacep.com.br/ws/$cep/json/";
 
        // Faz a requisição para a API
        $response = file_get_contents($url);
 
        // Decodifica a resposta JSON
        $endereco = json_decode($response, true);
 
        // Verifica se o CEP é válido
        if (isset($endereco['erro']) && $endereco['erro'] == true) {
            echo "CEP inválido!";
        } else {
            // Exibe o endereço
            echo "Endereço: " . $endereco['logradouro'] . "<br>";
            echo "Bairro: " . $endereco['bairro'] . "<br>";
            echo "Cidade: " . $endereco['localidade'] . "<br>";
            echo "Estado: " . $endereco['uf'] . "<br>";
        }
    } else {
        echo "CEP inválido! O CEP deve conter 8 números.";
    }
} else {
    // Formulário simples para o usuário inserir o CEP
    echo '
    <form method="GET">
        <label for="cep">Digite o CEP:</label>
        <input type="text" id="cep" name="cep" placeholder="Ex: 01001000" required>
        <button type="submit">Consultar</button>
    </form>';
}
?>
 