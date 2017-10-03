<?php
namespace Grav\Plugin;
class passwordgenTwigExtension extends \Twig_Extension
{
    public function getName()
    {
        return 'passwordgenTwigExtension';
    }
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('passwordgen', [$this, 'passwordgenFunction'])
        ];
    }
    public function passwordgenFunction($pwLen=8, $specialChars=false, $pwCount=1)
    {
      $pwLen = $this->inputFilterInteger($pwLen);
      $specialChars = $this->inputFilterBoolean($specialChars);
      $pwCount = $this->inputFilterInteger($pwCount);
      $htmlOut = "<div id=\"passwordgen\">\n";
      if ($pwLen === false || $pwCount === false) {
        return (string) "Plugin-Error: wrong parameters.";
      }
      for ($i=0; $i<$pwCount; $i++) {
        $htmlOut .= "<span class=\"passwordgen-password\">".
                      htmlentities($this->rgPasswordGenerator($pwLen, $specialChars))
                    ."</span>\n";
      }
      $htmlOut .= "</div>";
      return (string) $htmlOut;
    }

    protected function rgPasswordGenerator($pwLen=8, $specialChars=false) {
      $pwLen = $this->inputFilterInteger($pwLen);
      $specialChars = $this->inputFilterBoolean($specialChars);
      if ($pwLen === false || $pwLen <= 0) {
        $pwLen = 8; // Error -> Fallback -> Set $pwLen to 8
      }
      // Check: Is pwgen available? -> If yes, use it!
      if (function_exists('shell_exec') && $specialChars) {
        $genPass = shell_exec('pwgen --capitalize --numerals --ambiguous --symbols '.$pwLen);
      } elseif (function_exists('shell_exec') && !$specialChars) {
        $genPass = shell_exec('pwgen --capitalize --numerals --ambiguous '.$pwLen);
      }
      if (!empty($genPass)) {
        return (string) trim($genPass); // Return pwgen password.
      }
      // There is no pwgen -> Fallback to manual password-gen.
      $string[1] = "abcdefghjklmnopqrstuvwxyzabcde";
      $string[2] = "123456789987654321123456789";
      $string[3] = "ABCDEFGHJKLMNPQRSTUVWXYZABCDE";
      $string[4] = str_shuffle(".,-;#+()=?*&$%");
      $part1 = md5($string[1]);
      $part2 = md5($string[2]);
      $part3 = $string[3];
      $code = $part1.$part2.$part3.$part3;
      if ($specialChars) {
        $code .= substr(str_shuffle($string[4]), 0, 4); // Insert some special-chars
      }
      for ($i=0; $i<100; $i++) {
        $code = str_shuffle($code);
      }
      return (string) trim(substr($code, 0, $pwLen));
    }

    protected function inputFilterInteger($in) {
      $wert = filter_var($in, FILTER_VALIDATE_INT);
      if ($wert === NULL || $wert === false) {
        return (bool)false;
      } else {
        return (int)$wert;
      }
    }

    protected function inputFilterBoolean($in) {
      $wert = filter_var($in, FILTER_VALIDATE_BOOLEAN);
      if ($wert === NULL || $wert === false) {
        return (bool)false;
      } else {
        return (bool)true;
      }
    }

}
?>
