<?php
     define('AES_256_CBC', 'aes-256-cbc');
     function encrypt(string $value) : string{
          $encryption_key = "I computer sono incredibilmente veloci, accurati e stupidi. Gli uomini sono incredibilmente lenti, inaccurati e intelligenti. L'insieme dei due costituisce una forza incalcolabile.";
          $iv = "‡©µÒúÑ»n";
          return openssl_encrypt($value, AES_256_CBC, $encryption_key, 0, $iv);
     }

     function decrypt(string $value) : string{
          $encryption_key = "I computer sono incredibilmente veloci, accurati e stupidi. Gli uomini sono incredibilmente lenti, inaccurati e intelligenti. L'insieme dei due costituisce una forza incalcolabile.";
          $iv = "‡©µÒúÑ»n";
          return openssl_decrypt($value, AES_256_CBC, $encryption_key, 0, $iv);
     }
?>
