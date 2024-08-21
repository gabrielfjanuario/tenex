## GABRIEL FERNANDES JANUÁRIO
(11) 99368-4535 (WhatsApp)

![LinkedIn](https://br.linkedin.com/in/gabriel-januario)
![Portfolio](https://www.gabrieljanuario.com)
![Contato WhatsApp](https://api.whatsapp.com/send?phone=5511993684535&text=Gostei%20do%20seu%20desafio.%20Vamos%20conversar%3F) 


### Instalação
- Configure o webroot para apontar para /public/index.php

### Uso 

- [POST] Carne > CREATE 
```bash
  <?php
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.carne.test/carne/create',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('valor_total' => '0.3','qtd_parcelas' => '2','data_primeiro_vencimento' => '2024-08-01','periodicidade' => 'semanal','valor_entrada' => '0.10'),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
```

- [GET] Carne
```bash
    <?php

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.carne.test/carne/123',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
```