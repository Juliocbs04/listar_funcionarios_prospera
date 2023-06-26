<?php
    function listar_todos($acao){
        $username = 'USUARIO';
        $password = 'SENHA_SECRETA';
        
        if (isset($acao)) {
            $url = "http://api.willcode.tech/funcionarios/?ACAO=".$acao.
            "&USUARIO=".$username.
            "&SENHA=".$password;
        
            $ch = curl_init($url);

            // Set the option to return the response as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            try{
                // Fazer a requisição
                $response = curl_exec($ch);
                $data = json_decode($response);
               
                if ($data !== null) {
                    return $data;
                } else {
                    echo "Sem registros retornados";
                    return;
                }
                
            }catch(Exception $e){
                echo "Erro: " . $e->getMessage();
                return;
            }finally{
                // Fechar a sessão cURL
                curl_close($ch);
            }
            
        }else{
            echo 'Ação não foi Informada!!!';
            return;
        } 

        
    }

    function listar_filtro($filtro,$valor,$operador){
        $username = 'USUARIO';
        $password = 'SENHA_SECRETA';
        
        if ($filtro=='NomeCompleto'){
            $valor=urlencode($valor);
        }
        if ($filtro=='DataNascimento'){
            if (strpos($valor, '/') !== false) {
                $formato = "d/m/Y";
            } else {
                $formato = "dmY";
            }

            $date = DateTime::createFromFormat($formato, $valor);
            $valor = $date->format('Ymd');
        }

       if ($filtro == 'Salario'){
            $valor = str_replace(array(",00", ".",",",""), "", $valor);
       }

       if ($filtro=='id'){
        $url = "http://api.willcode.tech/funcionarios/?ACAO=LISTAR-FILTROS&USUARIO=".$username.
        "&SENHA=".$password.
        "&FILTRO=".$filtro.
        "&VALOR=".$valor;
        }else{
            $url = "http://api.willcode.tech/funcionarios/?ACAO=LISTAR-FILTROS&USUARIO=".$username.
        "&SENHA=".$password.
        "&FILTRO=".$filtro.
        "&VALOR=".$valor.
        "&OPERADOR=".$operador;
        }

        $ch = curl_init($url);

        // Retornar a resposta como string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        try{
            // Fazer a requisição
            $response = curl_exec($ch);
            $data = json_decode($response);
            if ($data !== null) {
                return $data;
            } else {
                echo "Sem registros retornados";
                return;
            }
            
        }catch(Exception $e){
            echo "Erro: " . $e->getMessage();
            return;
        }finally{
            // Fechar a sessão cURL
            curl_close($ch);
        }
    }

?>