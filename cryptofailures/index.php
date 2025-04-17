<?php
$ENC_SECRET_KEY="0123456789vùznvkznvklnvljkdsnvlkdnvkdnvkndvlkndkvnkdnvkdnvkdnvkndvkndkvndknvkdnvkdnvkdnvkdnvkdnvkdnqkjdbvkjdbqsdknvk:vk:sdjbvksdjbvkdjbvkdjblsjdvnldjnicci";
$ENC_SECRET_KEY_2="bbvnlnbmz,vùznvkznvklnvljkdsnvlkdnvkdnvkndvlkndkvnkdnvkdnvkdnvkndvkndkvndknvkdnvkdnvkdnvkdnvkdnvkdnqkjdbvkjdbqsdknvk:vk:sdjbvksdjbvkdjbvkdjblsjdvnldjnicci";
$user='guest';
$admin="admin";

$user_agent="Mozilla/5.0 (X11; Linux x86_64; rv:137.0) Gecko/20100101 Firefox/137.0";

function generate_cookie($user,$user_agent,$ENC_SECRET_KEY, $SALT) {
    
    $secure_cookie_string = $user.":".$user_agent.":".$ENC_SECRET_KEY;

    $secure_cookie = make_secure_cookie($secure_cookie_string,$SALT);

    setcookie("secure_cookie",$secure_cookie,time()+3600,'/','',false); 
    setcookie("user","$user",time()+3600,'/','',false);
}

function cryptstring($what,$SALT){

	return crypt($what,$SALT);

}


function make_secure_cookie($text,$SALT) {

	$secure_cookie='';

	foreach ( str_split($text,8) as $el ) {
    		$secure_cookie .= cryptstring($el,$SALT);
	}

	return($secure_cookie);
}


function generatesalt($n) {
	$randomString='';
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	for ($i = 0; $i < $n; $i++) {
    		$index = rand(0, strlen($characters) - 1);
    		$randomString .= $characters[$index];
	}
	return $randomString;
}



function verify_cookie($user, $crypted_cookie,$user_agent,$ENC_SECRET_KEY){
    $string=$user.":".$user_agent.":".$ENC_SECRET_KEY;
    $salt=substr($crypted_cookie,0,2);

    if(make_secure_cookie($string,$salt)===$crypted_cookie) {
        return true;
    } else {
        return false;
    }
}

function generate_combinations() {
    // Define the characters to use
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEiFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $combinations = [];

    // Loop through each character twice to generate all 2-character combinations
    for ($i = 0; $i < $charactersLength; $i++) {
        for ($j = 0; $j < $charactersLength; $j++) {
            $combinations[] = $characters[$i] . $characters[$j];
        }
    }

    return $combinations;
}

// Main
//$combinations = generate_combinations();
$combinations= ['pv'];
$text=$user.":".$user_agent.":".$ENC_SECRET_KEY;
$text_2=$user.":".$user_agent.":".$ENC_SECRET_KEY_2;
$text_admin=$admin.":".$user_agent.":".$ENC_SECRET_KEY;
$text_admin_2=$admin.":".$user_agent.":".$ENC_SECRET_KEY_2;
$SALT="pv";
$cookie_to_verify="pv7rrgpYl4mvIpvscziowzgsxspvZgqQJeLGqXwpv6IRBaaVqltcpv7Eg6zOmTTI.pvZIyeOex.3PQpvYSJLCiKU5VkpvZ6Cgw/IUjxApvZMlNCmHCQnEpvbX2HVqYU2ropv2K3kdFR3A2YpvI7LOKrfd8uopvgmkHOia2r66pvmTmIREmKI4QpvxfViBrfVXQcpvV2xvCXWbqBkpvuVUq4lyhsWspvPvHcfknifbkpvchhGb.cH9iUpvSxywEINpGDkpvKu9OWmu6fXUpvMrKrb6KGa5kpvtRbPg.UdwGwpvuY7uAr6O9PEpvh887OcH/b/.pvRAXxKBf39JUpvCGE38Pjz38IpvvyKBTx/t1NApvtb6Aw6dS2mw";

foreach ($combinations as $combination) {
	echo "Guest"."\n";
	echo "\t".$combination." 1->".make_secure_cookie($text,$combination) . "\n";
	echo "\t".$combination." 2->".make_secure_cookie($text_2,$combination) . "\n";
	echo "Admin"."\n";
        echo "\t".$combination." 1->".make_secure_cookie($text_admin,$combination) . "\n";
        echo "\t".$combination." 2->".make_secure_cookie($text_admin_2,$combination) . "\n";
}
    
?>
