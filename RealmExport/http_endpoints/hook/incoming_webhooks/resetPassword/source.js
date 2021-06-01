exports = async function(payload, response){
  var html="";
  var url = "";
  
  response.setHeader("Content-Type", "text/html");
  html+= '<html><head><title>Heres the Kids</title>';
  html+= '      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>';
  html+= '      <script src="https://s3.amazonaws.com/stitch-sdks/js/bundles/4.4.0/stitch.js"></script>';
  html+= '      <link href="http://grabosky.dyndns.org:9999/css/bootstrap/bootstrap.min.css" rel="stylesheet" />'
  html+= '      <link href="http://grabosky.dyndns.org:9999/HeresKids.styles.css" rel="stylesheet" />'
  html+= '      <link href="http://grabosky.dyndns.org:9999/css/site.css" rel="stylesheet" />'
  html+= '      <link href="http://grabosky.dyndns.org:9999/css/greg.css" rel="stylesheet" />'
  html+= '  </head> <body><div class="main"><div class="content"><div class="container">';
  html+= '          <div id="response"></div>';
  html+= '          <div>';
  html+= '              <form class="form-signin" id="form-signin">';
  html+= '                  <h1 class="capelli-page-title">Enter New Password</h1>';
  html+= '                  <label for="inputPassword" class="sr-only">Password</label><br>';
  html+= '                  <input type="password" id="txt_pw" class="form-control" placeholder="Password" required><br>';
  html+= '                  <button class="btn btn-lg btn-success btn-block" id="btn_submit">Reset</button>';
  html+= '              </form>';
  html+= '          </div>';
  html+= '          <script>';
  html+= '              const client = stitch.Stitch.initializeDefaultAppClient("greg-equfv");';
  html+= '              const url = window.location.search;';
  html+= '              const params = new URLSearchParams(url);';
   html+= '             const token = params.get("token");';
   html+= '             const tokenId = params.get("tokenId");';
  html+= '              $("#form-signin").submit(function(e) {';
 html+= '                   e.preventDefault();    ';
 html+= '                   resetPW();';
 html+= '                   return false;';
 html+= '               });';
 html+= '               function resetPW() {';
 html+= '                   const emailPassClient = client.auth.getProviderClient(stitch.UserPasswordAuthProviderClient.factory);';
  html+= '                  emailPassClient.resetPassword(token, tokenId, $("#txt_pw").val()).then(() => {';
  html+= '                      console.log("Successfully reset password!");';
  html+= '                      $("#response").html("It worked! <a href=\'http:/grabosky.dyndns.org:9999\'>Click Here</a>.");';
  html+= '                  }).catch(err => {';
  html+= '                      $("#response").html("Reset failed!");';
 html+= '                       console.log("Error resetting password:", err);';
  html+= '                  });';
  html+= '              }';
  html+= '          </script></div></div></div> </body></html>';
response.setBody(html);

      //response.setStatusCode(301);
      //response.setHeader("Location", url);

};