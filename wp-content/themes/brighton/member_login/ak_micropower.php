<html>
 <head>
  <title>Micropower API Integration Example</title>
 </head>
 <body>
 <?php 
 
// This simple example demonstrates how to:
// 1. Build an Authorisation header with your credentails to access the API.
// 2. Obtain a member authentication token.
// 3. Decode the member authentication token and retrieve useful memberids.
// 4. Use memberid to access more member data e.g. member profile.
// 5. Pass member authentication token into Micropower web portal for 
// automatic authentication. This is useful if you plan to run the Micropower 
// web portal embeded in a secure section of your site.

 // Live Production API URL
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
$loginData["Username"] = "ktbmmb@bigpond.net.au";//00427
$loginData["Password"] = "tkej081041"; //0810

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
            curl_setopt($curl, CURLOPT_PUT, 1);
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

	// Example: Login a user through the api.
	// On success: API will return 200 with a jwt token. e.g.
	// {
	//		"token":"xxxxxxxxxxxxxxxxxxxxxxxxxx"
	// }
	// On Failure: API will return 401.
	$logonResponse = CallAPI("POST", $BaseAPIurl . "security/authorisation/user", $loginData);
	
	// Parse the json Response
	$logonResponseData = json_decode($logonResponse, TRUE);

	// Decode the values in the jwt Token
	// This will return an array of claims.
	// More resources here: http://jwt.io/
	$tokenValue = $logonResponseData['token'];
	$JWTClaims = DecodeJWT($tokenValue);

	// The memberid claim can now be used to 
	// retrieve resources belonging to that member.
	// The JWT will also contain a claim called "nameid".
	// "nameid" is used by some Micropower products 
	// and can be useful when cross integrating. Or when
	// forcing a member record to refresh from the membership
	// system. 
	// Refresh Member Documentation: https://mpsapi.micropower.com.au/Help/Api/GET-v1-application-refresh-member_clubId_memberNo
	$memberId = $JWTClaims['memberid'];

	// Example: Retrieve full member profile using memberId
	/*$profileResponse = CallAPI("GET", $BaseAPIurl . "data/clubs/$venueId/members/$memberId", false);
	$MemberData = json_decode($profileResponse, TRUE);
	$MemberFields = $MemberData['fields'];*/
	
	$clubprofileResponse = CallAPI("GET", $BaseAPIurl . "data/clubs/$venueId/members", false);
    $clubdata = json_decode($clubprofileResponse, TRUE);
	
	echo "<pre>";print_r($clubdata);
	
	// Get a member's name from the fields 
	// returned in the profile data.
	foreach($MemberFields as $field)
	{
		if($field['name'] == "FirstName")
		{
			$firstname = $field['value'];
			break;
		}
	}

	echo "<h2>Welcome $firstname</h2>";

	// Example: Use the users login token to authenticate 
	// against the Micropower member portal, shown
	// running as an embeded solution.
	// *A token used in this way will be immediately expired.
	//echo "<iframe src='$BasePortalurl/$WebPortalTag/home?token=$tokenValue' width='1000' height='500'></iframe>";
 ?> 
 </body>
</html>