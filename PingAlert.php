<?php
/*
 * --------------------------------------------------------------------
 * ATENÇÃO, KIBADORES!
 * Desenvolvido por: @zBL4CKHATOFICIAL
 * Data: 26/08/2024
 * --------------------------------------------------------------------
 * Este código é resultado de trabalho árduo e dedicação. Se você está
 * utilizando este código, lembre-se de manter os créditos intactos.
 * Remover ou modificar os créditos é desrespeitoso e desonesto.
 * --------------------------------------------------------------------
 * Faça o seu trabalho corretamente: dê o crédito devido ao autor.
 * O esforço de cada desenvolvedor merece respeito. Se você está
 * copiando, ao menos tenha a decência de reconhecer o trabalho alheio.
 * --------------------------------------------------------------------
 */
?>
<?php


$urls = [
    'https://www.google.com/',
    'https://www.nasa.gov/',
    'https://www.nasa.gov/',
    'https://www.google.com/',
    'https://www.google.com/',
    'https://www.nasa.gov/',
    'https://www.nasa.gov/'
];


function check_url($url) {
    $start_time = microtime(true);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    // Desabilitar a verificação do certificado SSL
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    
    $response = curl_exec($ch);
    if ($response === false) {
        $http_code = 0;
        $error = curl_error($ch);
    } else {
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = null;
    }

    $end_time = microtime(true);
    curl_close($ch);

    $latency = ($end_time - $start_time) * 1000;

    return ['http_code' => $http_code, 'latency' => round($latency, 2), 'error' => $error];
}


function display_status($urls) {
    $output = '';
    $offline_detected = false; 

    foreach ($urls as $url) {
        $result = check_url($url);
        $http_code = $result['http_code'];
        $latency = $result['latency'];
        $error = $result['error'];

        $status = ($http_code == 200) ? 'Online' : 'Offline';
        $color = ($http_code == 200) ? '#4CAF50' : '#F44336';  

        if ($http_code != 200) {
            $offline_detected = true; 
        }

        $output .= "<tr style='background-color: " . $color . "; color: white;'>
            <td>{$url}</td>
            <td>{$status}</td>
            <td>{$http_code}</td>
            <td>{$latency} ms</td>
            <td>" . ($error ? $error : 'N/A') . "</td>
        </tr>";
    }

    return ['output' => $output, 'offline_detected' => $offline_detected];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status dos Serviços</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #333;
            text-align: left;
        }
        th {
            background-color: #333;
        }
        tr:nth-child(even) {
            background-color: #1e1e1e;
        }
        #timer {
            font-size: 1.2em;
            margin-bottom: 20px;
            color: #4CAF50;
        }
    </style>
    <script>
        const refreshInterval = 30000; 

        function startTimer() {
            const timerElement = document.getElementById('timer');
            let remainingTime = refreshInterval / 1000; 

            function updateTimer() {
                let minutes = Math.floor(remainingTime / 60);
                let seconds = remainingTime % 60;
                minutes = minutes < 10 ? '0' + minutes : minutes;
                seconds = seconds < 10 ? '0' + seconds : seconds;

                timerElement.textContent = `Próxima atualização em: ${minutes}:${seconds}`;
                remainingTime--;

                if (remainingTime < 0) {
                    remainingTime = refreshInterval / 1000; 
                    location.reload(); 
                }
            }

            updateTimer(); 
            setInterval(updateTimer, 1000); 
        }

       
        function playSound() {
            var audio = new Audio('alerta.mp3'); 
            audio.play();
        }

        document.addEventListener('DOMContentLoaded', function() {
            startTimer();

           
            <?php
            $status_info = display_status($urls);
            if ($status_info['offline_detected']) {
                echo 'playSound();';
            }
            ?>
        });
    </script>
</head>
<body>
    <h1>Status dos Serviços</h1>
    <div id="timer">Próxima atualização em: 00:30</div>
    <table>
        <thead>
            <tr>
                <th>URL</th>
                <th>Status</th>
                <th>Código HTTP</th>
                <th>Latência</th>
                <th>Erro</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $status_info['output']; ?>
        </tbody>
    </table>
</body>
</html>
