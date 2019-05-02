# VoguePay API Library Suit
<p>
    <a href="https://php.net" rel="nofollow">PHP</a> 5.5+ and <a href="https://getcomposer.org" rel="nofollow">Composer</a> are required.
</p>

<p>Installation Process</p>

<div class="highlight highlight-source-shell">
    <pre>composer require voguepay/voguepay</pre>
</div>

<p>After installation, include the VoguePay class in your code. Example below</p>
<div>
    <pre>
        require_once './vendor/autoload.php'; // location of the autoload file
        use VoguePay\voguepay;
    </pre>
</div>

<div>
    <p>The class would make available the following functions</p>
    <pre>
        voguepay::card($payLoad);
        voguepay::chargeToken($payLoad);
        voguepay::getResponse($transactionDetails);
    </pre>
</div>

<div>
    Using the PHP Library
    <div>
        Using the voguepay::card function
    </div>
    <pre>
        voguepay::card($payLoad);
    </pre>
    <pre>
    require_once './vendor/autoload.php'; // location to the autoload file of the composer
    use VoguePay\voguepay;
    $payLoad = [];
    $payLoad = [
        "version" => "2", // version of the API to be called
        "merchant" => [
            "merchantUsername" => "***", // Username of Merchant On VoguePay
            "merchantID" => "***-***", // Merchant ID of account on VoguePay
            "merchantEmail" => "***@gmail.com", // Registered email of account on VoguePay
            "apiToken" => "TUDMQ735hNKNaQCBkZYVHvjHqNBk", // Command API Key of account on VoguePay
            "publicKey" => file_get_contents('key.crt') // Public Key of account on Voguepay. This is to be copied and save to a file. The location of the file is to be replaced.
        ],
        "card" => [
            "name" => "***", //Card holder name
            "pan" => "******************", //Card pan number
            "month" => "05", //Card expiry month e.g 06
            "year" => "21", //Card expiry year e.g 21
            "cvv" => "***" //Card CVV number
        ],
        "customer" => [
            "email" => "***@gmail.com", // Email of customer
            "phone" => "***********", // phone number of customer
            "address" => "*************", // address of customer
            "state" => "********", // state or province of customer
            "zipCode" => "100005", // zip code of customer
            "country" => "Nigeria" // country of country - Valid country or valid 3 letter ISO
        ],
        "transaction" => [
            "amount" => 100, //amount to be charged
            "description" => "Payment Description Goes Here", //Description of payment
            "reference" => "1x2345vbn", // Unique transaction reference, this is returned with the transaction details
            "currency" => "USD", //Supported currency USD, GBP, EUR, NGN
        ],
        "notification" => [
            "callbackUrl" => "https://yourdomain.com/", // Url where a transaction details will be sent on transaction completion
            "redirectUrl" => "https://yourdomain.com/inspection" // Url where the customer is redirected on transaction completion
        ],
        "descriptor" => [
            "companyName" => "****", // {Optional} - Company name
            "countryIso" => "NGA" //3 letter country ISO
        ],
        "demo" => false, // boolean (true / false) , set to true to initiate a demo transaction and false for live transaction
    ];
    print_r(voguepay::card($data));
    </pre>
    <div>
        <p>Sample successful response below</p>
        <pre>
        stdClass Object
        (
            [description] => Redirection Required - 3D Authentication required. // Response code description
            [redirectUrl] => https://voguepay.com/?p=vpgate&ref=czoxMzoiNWNiZjQ2OTBlNDFkMCI7 // 3D redirection URL
            [reference] => 1x2345vbn // Transaction reference
            [response] => WL3D // Transaction response
            [status] => OK // API query status
            [transactionID] => 5cbf4690e41d0 // Generated VoguePay transaction ID
        )
        </pre>
        <p>On a successful API call, this returns an array of data, which includes the 3D authentication url. [redirectUrl]</p>
        <p>Redirect to the 3D authentication URL to complete transaction.</p>
        If there is an error, or a details prvoided is invalid, the status is represented as [status] => ERROR
        The status [status] => OK is not a representation of a successful transaction. To get transaction status check the usage for voguepay::getResponse()
    </div>
</div>