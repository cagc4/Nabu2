<?php

/*
The MIT License (MIT)

Copyright (c) <2016> <Carlos Alberto Garcia Cobo - carlosgc4@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

	Fecha creacion		= 15-09-2018
	Desarrollador		= CAGC
	Fecha modificacion	= 15-09-2018
	Usuario Modifico	= CAGC

*/

require "../Framework/Google/config.php";

class Login
{
    var $redirect_url;
    var $client_id;
    var $client_secret;
    var $api_key;


    function Login(){
        
        $this->redirect_url = 'http://nabugi.com/Nabu2/Core/Events/ValidateUser.php'; 
        $this->client_id = '225702401481-tslc05tn785dg1m41lh4h9jhvsquiipk.apps.googleusercontent.com';
        $this->client_secret = 'uIVfML4S33xsukHN-v8WKclS';
        $this->api_key = '';
                                
    }

    
    function getClient(){
        
        $client = new apiClient();
        $client->setClientId($this->client_id);
        $client->setClientSecret($this->client_secret);
        $client->setDeveloperKey($this->api_key);
        $client->setRedirectUri($this->redirect_url);
        $client->setApprovalPrompt(false);
        
        return $client; 
    }
    
    function start(){
        
        $client = $this->getClient();
        $oauth2 = new apiOauth2Service($client);
        $linkGoogle=$client->createAuthUrl();
        
        return $linkGoogle;
    }
    
    
    function getUser(){
        
        $client = $this->getClient();
        $oauth2 = new apiOauth2Service($client);
        
        $client->authenticate();
	    
        $info = $oauth2->userinfo->get();
	
        $person = ORM::for_table('nb_user_tbl')->where('nb_email_fld', $info['email'])->find_one();
	
	   if(!$person){
           $person = ORM::for_table('nb_user_tbl')->create();
		   $person->nb_email_fld = $info['email'];
		   $person->nb_descr_fld = $info['name'];
           
           
           $person->nb_user_fld =  $info['email'];
           $person->nb_enterprise_id_fld = 'nabufina';
           $person->nb_group_fld = '1';
           $person->nb_id_role_fld = '0';

           
		  if(isset($info['picture'])){
              $person->nb_photo_fld = $info['picture'];
		  }
		  else{
			$person->nb_photo_fld = '../Images/default_avatar.png';
        }
		
		$person->save();
	   }
	
	   $_SESSION['user_id'] = $person->id();
        
        return $info['email'];
	
    }
}

?>