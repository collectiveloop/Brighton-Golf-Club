<?php
$BaseAPIurl = "https://mpsapi.micropower.com.au/v1/";

// Live Production Web Portal URL

$BasePortalurl = "https://portal.micropower.com.au/";

// Unique to each venue. The Micropower web portal is a multitenanted website.
// The WebPortalTag is part of the url required to identify the club being 
// logged into.

$WebPortalTag = "brightongolfclub";

// Unique to each venue. The venueId (also refered to as clubId) can 
// be used to programaticly request club and member data through the API.

$venueId = "4091213";

// Test User Login details
// Build, encrypt then encode an Authorization 
// header required to access Micropower member api.

function BuildAuthHeader()
{
	$pubKey = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDSBRTQCakWaq17gSLqPO2tyerB
DNdiqSf7FE9mICzzOgNBqzH8mkvk9IucHzA1xAyWP6XgsgDBO3t7HvmlFp+99SES
d2Qzt+6hpWmsXqrjvQG112CezESIaMZ4LTKW//eV1GzfFGpziF6cNGzCh44fq5lR
WY8jJhk7TaTzOwZ39wIDAQAB
-----END PUBLIC KEY-----";

	// The signiture and secret identity provided to your organisation.
	// *Note these credentials are example only. You will need to contact 
	// service@micropower.com.au to obtain a set for your organisation. 
	// Be sure to include:
	// 1. The organisation you work for.
	// 2. The system you require a key for (MPSAPI).
	// 3. The reason for the request.
	// 4. Any client venues you are being contracted for or have a prospective contract for.
	
	$signature = "collectiveloop";
	$identity = "tGwu0UfmxSBH7SPNVHwrQXhFo4q6bdsqRRb3mw1R";
    //collectiveloop:tGwu0UfmxSBH7SPNVHwrQXhFo4q6bdsqRRb3mw1R:4091213
	$header = $signature.":".$identity.":".$GLOBALS['venueId'];
	openssl_public_encrypt($header ,$ecrypted ,$pubKey);

	return "Authorization:Basic ".base64_encode($ecrypted);
}

// Handling JWTs in PHP
// http://websec.io/2014/08/04/Securing-Requests-with-JWT.html


function DecodeJWT($token)
{
	$parts = explode('.', $token);
	$body = base64_decode($parts[1]);
	$bodyDecoded = json_decode($body, TRUE);
	return $bodyDecoded;
}

// Make a generic web request

function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            break;
        case "PUT":
            //curl_setopt($curl, CURLOPT_PUT, 1);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            break;
		case "DELETE":	
		    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
			if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
			break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

	// For watching with proxy(fiddler, charles etc)
	// curl_setopt($curl, CURLOPT_PROXY, '127.0.0.1:8888');

	// The content length header is also required but curl adds it anyway.
	// Api only supports json content. json content-type header must be included.
	
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(BuildAuthHeader(), "Content-Type:application/json"));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	// Required for https
	
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,  2);

    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}


function getCurlValue($filename, $contentType, $postname)
{
    // PHP 5.5 introduced a CurlFile object that deprecates the old @filename syntax
    // See: https://wiki.php.net/rfc/curl-file-upload
    if (function_exists('curl_file_create')) {
        return curl_file_create($filename, $contentType, $postname);
    }
 
    // Use the old style if using an older version of PHP
    $value = "@{$filename};filename=" . $postname;
    if ($contentType) {
        $value .= ';type=' . $contentType;
    }
 
    return $value;
}


function CallAPI_image($method, $url, $data = false)
{
    $curl = curl_init();
	
	curl_setopt($curl, CURLOPT_SAFE_UPLOAD, true);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

	// For watching with proxy(fiddler, charles etc)
	// curl_setopt($curl, CURLOPT_PROXY, '127.0.0.1:8888');

	// The content length header is also required but curl adds it anyway.
	// Api only supports json content. json content-type header must be included.
	
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(BuildAuthHeader(), "Content-Type:multipart/form-data"));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	// Required for https
	
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,  2);

    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}
?>